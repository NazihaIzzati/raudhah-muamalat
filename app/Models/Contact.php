<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'is_urgent',
        'admin_notes',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'deleted_at' => 'datetime',
        'is_urgent' => 'boolean',
    ];
    
    /**
     * Get the staff member who replied to this contact.
     */
    public function repliedBy()
    {
        return $this->belongsTo(Staff::class, 'replied_by');
    }
    
    /**
     * Get the full name of the contact (alias for name).
     */
    public function getFullNameAttribute()
    {
        return $this->name;
    }
    
    /**
     * Check if contact is new.
     */
    public function isNew()
    {
        return $this->status === 'unread';
    }
    
    /**
     * Check if contact has been replied to.
     */
    public function hasReply()
    {
        return $this->status === 'replied';
    }

    /**
     * Check if contact is urgent.
     */
    public function isUrgent()
    {
        return $this->is_urgent;
    }
    
    /**
     * Check if contact is deleted.
     */
    public function isDeleted()
    {
        return $this->deleted_at !== null;
    }
    
    /**
     * Get formatted deleted at date.
     */
    public function getDeletedAtFormattedAttribute()
    {
        return $this->deleted_at ? $this->deleted_at->format('M d, Y H:i') : null;
    }
    
    /**
     * Scope for active contacts (not deleted).
     */
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }
    
    /**
     * Scope for trashed contacts.
     */
    public function scopeTrashed($query)
    {
        return $query->onlyTrashed();
    }
    
    /**
     * Scope for filtering by status.
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }
    
    /**
     * Get status badge class.
     */
    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            'unread' => 'bg-blue-100 text-blue-800',
            'read' => 'bg-yellow-100 text-yellow-800',
            'replied' => 'bg-green-100 text-green-800',
            'closed' => 'bg-gray-100 text-gray-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }
    
    /**
     * Get status display name.
     */
    public function getStatusDisplayNameAttribute()
    {
        return match($this->status) {
            'unread' => 'Unread',
            'read' => 'Read',
            'replied' => 'Replied',
            'closed' => 'Closed',
            default => 'Unknown',
        };
    }
} 