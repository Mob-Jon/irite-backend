<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PublishedStory;
use App\Models\Review;
use App\Models\Story;

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

    public function stories_to_verify()
    {
        return response()->json(Story::all());
    }
    
    public function decline_story()
    {
        return response()->json("Sorry,your piece doesn't meet our requirements. Please try again");
    }
}
