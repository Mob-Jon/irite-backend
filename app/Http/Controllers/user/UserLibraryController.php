<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PublishedStory;
use App\Models\UserLibrary;

class UserLibraryController extends Controller
{
    
    //add story in library
    public function addToLibrary($publishedStory,$reader_id)
    {

        $stories = PublishedStory::where('id', $publishedStory)->first();
        $story = $stories->replicate();
        $story->setTable('user_libraries');
        $story->reader_id = $reader_id;
        // $story->update(['reader_id' => $reader_id]);
        $story->save();

        return response()->json($story);
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
}
