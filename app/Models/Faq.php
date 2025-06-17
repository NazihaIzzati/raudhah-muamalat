<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;
    
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
}
