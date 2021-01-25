<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;
use App\Models\User;

class Story extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'genre',
        'blurb',
        'story_flow',
        'user_id'
    ];

    protected $casts = [
        'genre'=>'array'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
