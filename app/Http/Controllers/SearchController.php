<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PublishedStory;


class SearchController extends Controller
{
    public function search($title)
    {
        return PublishedStory::where("title","like","%".$title."%")->get();

    }

    public function genre($genre){
        
        return PublishedStory::where("genre","like", "%".$genre."%")->get();
        
    }

}
