<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardzoneKey extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant_id',
        'merchant_private_key',
        'cardzone_public_key',
    ];

    // Cast keys to ensure they are handled as strings
    protected $casts = [
        'merchant_private_key' => 'string',
        'cardzone_public_key' => 'string',
    ];
}
