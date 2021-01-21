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
                'genre.*'=>'required',
                'blurb'=>'required',
                'storyFlow'=>'required'
            ]);

            $story = Story::create([
                'title'=>$request->title,
                'genre'=>$request->genre,
                'blurb'=>$request->blurb,
                'story-flow'=>$request->storyFlow
            ]);
            DB::commit();
            // return redirect()->route('myStories');
            return response()->json($story);
        }
        catch(Exception $e){
            DB::rollBack();
            // return response()->json('failed to create story');
            return redirect()->back();
        }
    }
    public function searchStory($title)
    {
        return Story::where('title','like','%'.$title.'%')->get();
    }
}
