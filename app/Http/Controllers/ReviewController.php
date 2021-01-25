<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Story;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        
        DB::beginTransaction();
         
        try {
            $request->validate([
                "user_id" => "required",
                "published_story_id" => "required",
                "review" => "required",
                "rating" => "required|min:1|max:5"
            ]);
                
            $review = Review::create($request->all());
            DB::commit();

            return response()->json($review);

        }catch(\Exception $e) {
            DB::rollback();
            return response()->json(["errors"=> "Unable to create reviews $e"]);
        }
        
    }

   
}
