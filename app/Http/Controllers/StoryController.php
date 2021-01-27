<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Story;
use App\Models\User;

class StoryController extends Controller
{

    public function storeStory(Request $request,User $user)
    {
        DB::beginTransaction();

        try{
            
            $request->validate([
                'title'=>'required',
                'genre.*'=>'required',
                'blurb'=>'required',
                'storyFlow'=>'required',
            ]);
            
            $story = $user->stories()->create([
                'title'=>$request->title,
                'genre'=>$request->genre,
                'blurb'=>$request->blurb,
                'story_flow'=>$request->storyFlow
            ]);

            // $check = $user->usertype;

            DB::commit();

            $story = Story::with('user')->find($story);

            return response()->json($story);
        }
        catch(Exception $e){
            DB::rollBack();

            return response()->json('failed to create story');
            
        }
    }

    // get stories
    public function getStory()
    {
        $stories = Story::all();

        return response()->json($stories);
    }
}
