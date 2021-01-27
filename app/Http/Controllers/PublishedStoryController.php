<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use App\Models\Story;
use App\Models\PublishedStory;
use App\Models\User;

class PublishedStoryController extends Controller
{
    // STORY TO VERIFY
    public function storyToPublish($story)
    {

        $stories = Story::where('id', $story)->first();
        $story = $stories->replicate();
        // $story = Story::with('user')->find($story);
        $story->setTable('published_stories');
        $story->save();
        $stories->delete();

        return response()->json();
        
    }

    public function userPublished($user)
    {
        $story = DB::table('published_stories')->where('user_id',$user)->get();
        return response()->json($story);
    }

}
