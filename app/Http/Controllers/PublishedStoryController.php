<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use App\Models\Story;
use App\Models\PublishedStory;

class PublishedStoryController extends Controller
{
    // STORY TO VERIFY
    public function storyToPublish($story)
    {

        $stories = Story::where('id', $story)->first();
        $story = $stories->replicate();
        $story->setTable('published_stories');
        $story->save();
        $stories->delete();

        return response()->json($story);
    }

}
