<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $table = 'portfolio';

    protected $fillable = [
        'title',
        'media_url',
        'description',
        'type',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];
}
