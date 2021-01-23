<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;

class SearchController extends Controller
{
    public function search($title)
    {
        // return response()->json($title);
        return Story::where("title","like","%".$title."%")->get();

    }

    public function filter_genre($genre){
        
    }

}
