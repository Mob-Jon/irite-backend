<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PublishedStory;

class UserHomeController extends Controller
{
    //users side
    public function getStory()
    {
        return response()->json(PublishedStory::all());
    }
}
