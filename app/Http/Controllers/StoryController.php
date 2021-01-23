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
                'storyFlow'=>'required',
                // 'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            // $imageName = time(). '.'. $request->image->extension();
            // $request->image->move(public_path('images'), $imageName);
            $story = Story::create([
                'title'=>$request->title,
                'genre'=>$request->genre,
                'blurb'=>$request->blurb,
                'story_flow'=>$request->storyFlow,
                // 'image'=>$imageName
            ]);

            DB::commit();

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
