<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use HasFactory, SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'logo',
        'url',
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
     * Get the staff member who created this partner.
     */
    public function creator()
    {
        return $this->belongsTo(Staff::class, 'created_by');
    }
    
    /**
     * Check if partner is active.
     */
    public function isActive()
    {
        return $this->status === 'active';
    }
    
    /**
     * Check if partner is featured.
     */
    public function isFeatured()
    {
        return $this->featured;
    }
    
    /**
     * Check if partner is soft deleted.
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
     * Scope to get only active partners (not soft deleted).
     */
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }
    
    /**
     * Scope to get only soft deleted partners.
     */
    public function scopeTrashed($query)
    {
        return $query->onlyTrashed();
    }
}
