<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PublishedStory;

class AdminController extends Controller
{
    public function getStory()
    {
        return response()->json(PublishedStory::all());
    }
}
