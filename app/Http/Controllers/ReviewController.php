<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Story;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function store(Request $request,$user, $story)
    {
        
        DB::beginTransaction();
         
        try {
            $request->validate([
                // "user_id" => "required",
                // "published_story_id" => "required",
                "review" => "required",
                "rating" => "min:1|max:5"
            ]);
                
             $review = Review::create([

                'user_id'=>$user,
                'story_id'=>$story,
                'review'=>$request->review,
                'rating'=>$request->rating

            ]);
            $review = Review::with('story')->find($story);
            DB::commit();

            return response()->json($review);

        }catch(\Exception $e) {
            DB::rollback();
            return response()->json(["errors"=> "Unable to create reviews $e"]);
        }
        
    }

    public function getReview()
    {
        return response()->json(Review::all());
    }
   public function getReviewByStory($story)
   {
       $review = Review::where('story_id',$story)->get()->first();
       return response()->json($review);
   }
}
