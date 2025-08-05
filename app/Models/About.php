<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class About extends Model
{
    use HasFactory, SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'mission',
        'vision',
        'values',
        'bank_muamalat_title',
        'bank_muamalat_description',
        'payment_section_title',
        'payment_section_description',
        'fpx_description',
        'duitnow_description',
        'hero_badge_text',
        'hero_title',
        'hero_subtitle',
        'hero_description',
        'hero_highlights',
        'hero_pills',
        'hero_cta_buttons',
        'status',
        'display_order',
        'is_active',
        'created_by',
        'updated_by',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'hero_highlights' => 'array',
        'hero_pills' => 'array',
        'hero_cta_buttons' => 'array',
        'is_active' => 'boolean',
        'display_order' => 'integer',
    ];
    
    /**
     * Get the staff member who created this about content.
     */
    public function creator()
    {
        return $this->belongsTo(Staff::class, 'created_by');
    }
    
    /**
     * Get the staff member who last updated this about content.
     */
    public function updater()
    {
        return $this->belongsTo(Staff::class, 'updated_by');
    }
    
    /**
     * Check if about content is active.
     */
    public function isActive()
    {
        return $this->status === 'active' && $this->is_active;
    }
    
    /**
     * Check if about content is soft deleted.
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
     * Scope to get only active about content (not soft deleted).
     */
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at')->where('is_active', true);
    }
    
    /**
     * Scope to get only soft deleted about content.
     */
    public function scopeTrashed($query)
    {
        return $query->onlyTrashed();
    }
    
    /**
     * Get the first active about content.
     */
    public static function getActive()
    {
        return static::active()->orderBy('display_order')->first();
    }
}
