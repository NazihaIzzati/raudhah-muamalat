<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use HasFactory, SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'question',
        'answer',
        'category',
        'status',
        'featured',
        'display_order',
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
    ];
    
    /**
     * Get the user who created this FAQ.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    /**
     * Check if FAQ is active.
     */
    public function isActive()
    {
        return $this->status === 'active';
    }
    
    /**
     * Check if FAQ is featured.
     */
    public function isFeatured()
    {
        return $this->featured;
    }
    
    /**
     * Get the available categories.
     */
    public static function getCategories()
    {
        return [
            'general' => 'General',
            'donations' => 'Donations',
            'campaigns' => 'Campaigns',
            'operations' => 'Operations',
            'partnerships' => 'Partnerships',
        ];
    }
    
    /**
     * Check if FAQ is soft deleted.
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
     * Scope to get only active FAQs (not soft deleted).
     */
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }
    
    /**
     * Scope to get only soft deleted FAQs.
     */
    public function scopeTrashed($query)
    {
        return $query->onlyTrashed();
    }
}
