<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignAuditTrail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'campaign_id',
        'action',
        'description',
        'old_values',
        'new_values',
        'performed_by',
        'ip_address',
        'user_agent',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    /**
     * Get the campaign that owns the audit trail.
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    /**
     * Get the staff member who performed the action.
     */
    public function performer()
    {
        return $this->belongsTo(Staff::class, 'performed_by');
    }

    /**
     * Get the action type with human-readable label.
     */
    public function getActionLabelAttribute()
    {
        return match($this->action) {
            'created' => 'Campaign Created',
            'updated' => 'Campaign Updated',
            'status_changed' => 'Status Changed',
            'featured_toggled' => 'Featured Status Changed',
            'goal_updated' => 'Goal Amount Updated',
            'donation_received' => 'Donation Received',
            'milestone_reached' => 'Milestone Reached',
            'completed' => 'Campaign Completed',
            'deleted' => 'Campaign Deleted',
            'restored' => 'Campaign Restored',
            default => ucfirst(str_replace('_', ' ', $this->action))
        };
    }

    /**
     * Get the action icon.
     */
    public function getActionIconAttribute()
    {
        return match($this->action) {
            'created' => 'M12 6v6m0 0v6m0-6h6m-6 0H6',
            'updated' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
            'status_changed' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
            'featured_toggled' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z',
            'goal_updated' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1',
            'donation_received' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
            'milestone_reached' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
            'completed' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
            'deleted' => 'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16',
            'restored' => 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15',
            default => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'
        };
    }

    /**
     * Get the action color class.
     */
    public function getActionColorAttribute()
    {
        return match($this->action) {
            'created' => 'bg-green-100 text-green-800',
            'updated' => 'bg-blue-100 text-blue-800',
            'status_changed' => 'bg-purple-100 text-purple-800',
            'featured_toggled' => 'bg-yellow-100 text-yellow-800',
            'goal_updated' => 'bg-indigo-100 text-indigo-800',
            'donation_received' => 'bg-emerald-100 text-emerald-800',
            'milestone_reached' => 'bg-pink-100 text-pink-800',
            'completed' => 'bg-green-100 text-green-800',
            'deleted' => 'bg-red-100 text-red-800',
            'restored' => 'bg-orange-100 text-orange-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    /**
     * Scope for filtering by action type.
     */
    public function scopeByAction($query, $action)
    {
        return $query->where('action', $action);
    }

    /**
     * Scope for recent audit trails.
     */
    public function scopeRecent($query, $limit = 10)
    {
        return $query->orderBy('created_at', 'desc')->limit($limit);
    }

    /**
     * Get formatted changes for display.
     */
    public function getFormattedChangesAttribute()
    {
        if (!$this->old_values || !$this->new_values) {
            return null;
        }

        $changes = [];
        foreach ($this->new_values as $field => $newValue) {
            $oldValue = $this->old_values[$field] ?? null;
            if ($oldValue !== $newValue) {
                $changes[] = [
                    'field' => ucfirst(str_replace('_', ' ', $field)),
                    'old' => $oldValue,
                    'new' => $newValue
                ];
            }
        }

        return $changes;
    }
} 