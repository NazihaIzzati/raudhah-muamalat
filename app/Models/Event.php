<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory, SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'featured_image',
        'location',
        'address',
        'latitude',
        'longitude',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'max_participants',
        'registered_participants',
        'registration_fee',
        'currency',
        'category',
        'status',
        'is_featured',
        'registration_required',
        'registration_deadline',
        'contact_info',
        'social_links',
        'created_by',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'registration_deadline' => 'datetime',
        'registration_fee' => 'decimal:2',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'is_featured' => 'boolean',
        'registration_required' => 'boolean',
        'contact_info' => 'array',
        'social_links' => 'array',
    ];
    
    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title);
            }
        });
        
        static::updating(function ($event) {
            if ($event->isDirty('title') && empty($event->slug)) {
                $event->slug = Str::slug($event->title);
            }
        });
    }
    
    /**
     * Get the staff member who created this event.
     */
    public function creator()
    {
        return $this->belongsTo(Staff::class, 'created_by');
    }
    
    /**
     * Check if event is published.
     */
    public function isPublished()
    {
        return $this->status === 'published';
    }
    
    /**
     * Check if event is ongoing.
     */
    public function isOngoing()
    {
        return $this->status === 'ongoing';
    }
    
    /**
     * Check if event is completed.
     */
    public function isCompleted()
    {
        return $this->status === 'completed';
    }
    
    /**
     * Check if registration is open.
     */
    public function isRegistrationOpen()
    {
        if (!$this->registration_required) {
            return false;
        }
        
        if ($this->registration_deadline && now()->isAfter($this->registration_deadline)) {
            return false;
        }
        
        if ($this->max_participants && $this->registered_participants >= $this->max_participants) {
            return false;
        }
        
        return $this->isPublished();
    }
    
    /**
     * Get available spots for registration.
     */
    public function availableSpots()
    {
        if (!$this->max_participants) {
            return null;
        }
        
        return max(0, $this->max_participants - $this->registered_participants);
    }
    
    /**
     * Get registration percentage.
     */
    public function registrationPercentage()
    {
        if (!$this->max_participants) {
            return 0;
        }
        
        return min(100, round(($this->registered_participants / $this->max_participants) * 100));
    }
    
    /**
     * Check if event has passed.
     */
    public function hasPassed()
    {
        $endDateTime = $this->end_date ?? $this->start_date;
        return now()->isAfter($endDateTime);
    }
    
    /**
     * Get formatted date range.
     */
    public function getDateRangeAttribute()
    {
        if ($this->end_date && $this->start_date->format('Y-m-d') !== $this->end_date->format('Y-m-d')) {
            return $this->start_date->format('M j, Y') . ' - ' . $this->end_date->format('M j, Y');
        }
        
        return $this->start_date->format('M j, Y');
    }
    
    /**
     * Get formatted time range.
     */
    public function getTimeRangeAttribute()
    {
        if ($this->start_time && $this->end_time) {
            return $this->start_time->format('g:i A') . ' - ' . $this->end_time->format('g:i A');
        } elseif ($this->start_time) {
            return $this->start_time->format('g:i A');
        }
        
        return null;
    }
}
