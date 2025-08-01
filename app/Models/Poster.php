<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Poster extends Model
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
        'image_path',
        'description',
        'status',
        'category',
        'featured',
        'file_size',
        'display_from',
        'display_until',
        'display_order',
        'campaign_id',
        'created_by',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'display_from' => 'date',
        'display_until' => 'date',
        'display_order' => 'integer',
        'featured' => 'boolean',
        'file_size' => 'integer',
    ];
    
    /**
     * Get the staff member who created this poster.
     */
    public function creator()
    {
        return $this->belongsTo(Staff::class, 'created_by');
    }
    
    /**
     * Get the campaign associated with this poster.
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
    
    /**
     * Check if poster is published.
     */
    public function isPublished()
    {
        return $this->status === 'published';
    }
    
    /**
     * Check if poster is active (published and in display period).
     */
    public function isActive()
    {
        return $this->isPublished() && $this->isInDisplayPeriod();
    }
    
    /**
     * Check if poster is currently within display date range.
     */
    public function isInDisplayPeriod()
    {
        $today = now()->startOfDay();
        
        $startCondition = !$this->display_from || $today->gte($this->display_from);
        $endCondition = !$this->display_until || $today->lte($this->display_until);
        
        return $startCondition && $endCondition;
    }
}
