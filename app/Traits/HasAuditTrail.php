<?php

namespace App\Traits;

use App\Models\CampaignAuditTrail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait HasAuditTrail
{
    /**
     * Boot the trait and add model events.
     */
    protected static function bootHasAuditTrail()
    {
        static::created(function ($model) {
            $model->logAuditTrail('created', 'Campaign was created');
        });

        static::updated(function ($model) {
            $model->logAuditTrail('updated', 'Campaign was updated', $model->getOriginal(), $model->getAttributes());
        });

        static::deleted(function ($model) {
            $model->logAuditTrail('deleted', 'Campaign was deleted');
        });

        static::restored(function ($model) {
            $model->logAuditTrail('restored', 'Campaign was restored');
        });
    }

    /**
     * Log an audit trail entry.
     */
    public function logAuditTrail($action, $description, $oldValues = null, $newValues = null)
    {
        // Only log if this is a Campaign model
        if (!$this instanceof \App\Models\Campaign) {
            return;
        }

        // Get the current user/staff member
        $performedBy = null;
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->staff) {
                $performedBy = $user->staff->id;
            }
        }

        // Create audit trail entry
        CampaignAuditTrail::create([
            'campaign_id' => $this->id,
            'action' => $action,
            'description' => $description,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'performed_by' => $performedBy,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }

    /**
     * Log a specific action with custom description.
     */
    public function logCustomAction($action, $description, $oldValues = null, $newValues = null)
    {
        $this->logAuditTrail($action, $description, $oldValues, $newValues);
    }

    /**
     * Log status change specifically.
     */
    public function logStatusChange($oldStatus, $newStatus)
    {
        $this->logAuditTrail(
            'status_changed',
            "Campaign status changed from {$oldStatus} to {$newStatus}",
            ['status' => $oldStatus],
            ['status' => $newStatus]
        );
    }

    /**
     * Log featured status change.
     */
    public function logFeaturedChange($oldFeatured, $newFeatured)
    {
        $oldStatus = $oldFeatured ? 'Featured' : 'Not Featured';
        $newStatus = $newFeatured ? 'Featured' : 'Not Featured';
        
        $this->logAuditTrail(
            'featured_toggled',
            "Campaign featured status changed from {$oldStatus} to {$newStatus}",
            ['featured' => $oldFeatured],
            ['featured' => $newFeatured]
        );
    }

    /**
     * Log goal amount change.
     */
    public function logGoalChange($oldGoal, $newGoal)
    {
        $this->logAuditTrail(
            'goal_updated',
            "Campaign goal amount changed from " . number_format($oldGoal, 2) . " to " . number_format($newGoal, 2),
            ['goal_amount' => $oldGoal],
            ['goal_amount' => $newGoal]
        );
    }

    /**
     * Log donation received.
     */
    public function logDonationReceived($amount, $donorName = null)
    {
        $description = "Donation received: " . number_format($amount, 2);
        if ($donorName) {
            $description .= " from {$donorName}";
        }
        
        $this->logAuditTrail('donation_received', $description);
    }

    /**
     * Log milestone reached.
     */
    public function logMilestoneReached($milestone, $percentage)
    {
        $this->logAuditTrail(
            'milestone_reached',
            "Campaign reached {$milestone} milestone ({$percentage}% funded)"
        );
    }

    /**
     * Log campaign completion.
     */
    public function logCompletion()
    {
        $this->logAuditTrail('completed', 'Campaign was marked as completed');
    }
} 