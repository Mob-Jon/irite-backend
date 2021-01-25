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
        // $comment = new Comment;

        // $comment->comment = $request->comment;

        // $comment->user()->associate($request->user());

        // $post = Story::find($request->post_id);

        // $post->comments()->save($comment);

        // return back();
        DB::beginTransaction();
         
        try {
            $request->validate([
                "user_id" => "required",
                "story_id" => "required",
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

    // public function replyStore(Request $request)
    // {
    //     $reply = new Review();

    //     $reply->comment = $request->get('comment');

    //     $reply->user()->associate($request->user());

    //     $reply->parent_id = $request->get('comment_id');

    //     $post = Post::find($request->get('post_id'));

    //     $post->comments()->save($reply);

    //     return back();

    // }
}
