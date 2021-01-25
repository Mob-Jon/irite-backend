<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\PublishedStory;
use App\Models\User;

class Review extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function story()
    {
        return $this->belongsTo(PublishedStory::class);
    }
}
