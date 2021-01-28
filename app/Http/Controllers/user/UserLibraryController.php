<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PublishedStory;
use App\Models\UserLibrary;

class UserLibraryController extends Controller
{
    
    //add story in library
    public function addToLibrary($storyId,$readerId)
    {

        // $story = UserLibrary::where('reader_id',$readerId)->first()->where('id',$storyId);

        // if(!$story){
            $stories = PublishedStory::where('id', $storyId)->first();
            $story = $stories->replicate();
            $story->setTable('user_libraries');
            $story->reader_id = $readerId;
            $story->save();
            
            return response()->json($story);

        // }else{

            // return response()->json('existed');
        // }  
    }

    //delete story in library
    public function deleteFromLibrary(UserLibrary $story)
    {
        $deleteStory = $story->delete();
        return response()->json($deleteStory);
    }

    public function getFromLibrary($reader_id)
    {
       return response()->json(UserLibrary::where('reader_id',$reader_id)->get());
    }

    public function getallFromLibrary()
    {
        return response()->json(UserLibrary::all());
    }
}
