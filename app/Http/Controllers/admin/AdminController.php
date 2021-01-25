<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PublishedStory;
use App\Models\Review;

class AdminController extends Controller
{
    public function dashboard()
    {
        return response()->json(PublishedStory::all());
    }
     public function byRating()
     {
        $story = PublishedStory::withCount('reviews')->get();
            

        return response()->json(['story' => $story]);
     }
    
    
}
