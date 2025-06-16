<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'message',
        'data',
        'read_at',
        'icon',
        'color',
        'action_url'
    ];

    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Scopes
    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    public function scopeRead($query)
    {
        return $query->whereNotNull('read_at');
    }

    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', Carbon::now()->subDays($days));
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Accessors
    public function getIsReadAttribute()
    {
        return !is_null($this->read_at);
    }

    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    // Methods
    public function markAsRead()
    {
        $this->update(['read_at' => now()]);
    }

    public function markAsUnread()
    {
        $this->update(['read_at' => null]);
    }

    // Static methods for creating notifications
    public static function createDonationNotification($donation)
    {
        return self::create([
            'type' => 'donation',
            'title' => 'New Donation Received',
            'message' => ($donation->user ? $donation->user->name : 'Anonymous') . 
                        ' donated $' . number_format($donation->amount, 2) . 
                        ' to ' . ($donation->campaign ? $donation->campaign->title : 'General Fund'),
            'data' => [
                'donation_id' => $donation->id,
                'user_id' => $donation->user_id,
                'campaign_id' => $donation->campaign_id,
                'amount' => $donation->amount
            ],
            'icon' => 'donation',
            'color' => 'green',
            'action_url' => route('admin.donations.show', $donation->id)
        ]);
    }

    public static function createUserRegistrationNotification($user)
    {
        return self::create([
            'type' => 'user_registration',
            'title' => 'New User Registration',
            'message' => $user->name . ' has registered as a new user',
            'data' => [
                'user_id' => $user->id,
                'email' => $user->email,
                'role' => $user->role
            ],
            'icon' => 'user',
            'color' => 'blue',
            'action_url' => route('admin.users.show', $user->id)
        ]);
    }

    public static function createCampaignNotification($campaign)
    {
        return self::create([
            'type' => 'campaign_created',
            'title' => 'New Campaign Created',
            'message' => 'Campaign "' . $campaign->title . '" has been created',
            'data' => [
                'campaign_id' => $campaign->id,
                'goal_amount' => $campaign->goal_amount
            ],
            'icon' => 'campaign',
            'color' => 'orange',
            'action_url' => route('admin.campaigns.show', $campaign->id)
        ]);
    }
}
