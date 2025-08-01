<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
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
        'content',
        'image_path',
        'excerpt',
        'status',
        'category',
        'featured',
        'display_order',
        'published_at',
        'created_by',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'featured' => 'boolean',
        'display_order' => 'integer',
        'published_at' => 'datetime',
    ];
    
    /**
     * Get the user who created this news.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    /**
     * Check if news is active.
     */
    public function isActive()
    {
        return $this->status === 'active';
    }
    
    /**
     * Check if news is featured.
     */
    public function isFeatured()
    {
        return $this->featured;
    }
    
    /**
     * Check if news is published.
     */
    public function isPublished()
    {
        return $this->status === 'published';
    }
    
    /**
     * Get the available categories.
     */
    public static function getCategories()
    {
        return [
            'general' => 'General',
            'announcement' => 'Announcement',
            'event' => 'Event',
            'campaign' => 'Campaign',
            'update' => 'Update',
        ];
    }
    
    /**
     * Check if news is soft deleted.
     */
    public function isDeleted()
    {
        return $this->deleted_at !== null;
    }
    
    /**
     * Get the formatted deleted date.
     */
    public function getDeletedAtFormattedAttribute()
    {
        return $this->deleted_at ? $this->deleted_at->format('M d, Y H:i') : null;
    }
    
    /**
     * Scope to get only active news (not soft deleted).
     */
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }
    
    /**
     * Scope to get only soft deleted news.
     */
    public function scopeTrashed($query)
    {
        return $query->onlyTrashed();
    }
}
