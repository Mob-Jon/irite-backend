<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Story;

class StoryController extends Controller
{
    public function storeStory(Request $request)
    {
        DB::beginTransaction();

        try{
            $request->validate([
                'title'=>'required',
                'genre'=>'required',
                'description'=>'required',
                'storyFlow'=>'required'
            ]);

            Story::create([
                'title'=>$request->title,
                'genre'=>$request->genre,
                'description'=>$request->description,
                'story-flow'=>$request->storyFlow
            ]);
            DB::commit();
            return response()->json('story created');
        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json('failed to create story');
        }
    }
}
