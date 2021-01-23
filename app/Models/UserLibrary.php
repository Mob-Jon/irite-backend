<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLibrary extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'genre',
        'blurb',
        'story_flow',
        // 'image'
    ];

    protected $casts = [
        'genre'=>'array'
    ];
}
