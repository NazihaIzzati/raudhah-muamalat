<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;
    
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
     * Get the user who created this partner.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
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
}
