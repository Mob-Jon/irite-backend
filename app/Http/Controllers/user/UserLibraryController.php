<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PublishedStory;
use App\Models\UserLibrary;

class UserLibraryController extends Controller
{
    
    //add story in library
    public function addToLibrary($publishedStory)
    {

        $stories = PublishedStory::where('id', $publishedStory)->first();
        $story = $stories->replicate();
        $story->setTable('user_libraries');
        $story->save();
        $stories->delete();

        return response()->json($story);
    }

    //delete story in library
    public function deleteFromLibrary(Request $request, UserLibrary $story)
    {
        $deleteStory = $story->delete();

        return response()->json($deleteStory);
    }
}
