<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'is_urgent',
        'admin_notes',
        'replied_by',
        'replied_at',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_urgent' => 'boolean',
        'replied_at' => 'datetime',
    ];
    
    /**
     * Get the user who replied to this contact.
     */
    public function repliedBy()
    {
        return $this->belongsTo(User::class, 'replied_by');
    }
    
    /**
     * Get the full name of the contact.
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    
    /**
     * Check if contact is new.
     */
    public function isNew()
    {
        return $this->status === 'new';
    }
    
    /**
     * Check if contact is urgent.
     */
    public function isUrgent()
    {
        return $this->is_urgent;
    }
    
    /**
     * Check if contact has been replied to.
     */
    public function hasReply()
    {
        return $this->status === 'replied';
    }
    
    /**
     * Scope for filtering by status.
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }
    
    /**
     * Scope for urgent contacts.
     */
    public function scopeUrgent($query)
    {
        return $query->where('is_urgent', true);
    }
} 