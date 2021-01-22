<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Story;
use App\Models\User;


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
                'storyFlow'=>'required'
            ]);

            $story = Story::create([
                'title'=>$request->title,
                'genre'=>$request->genre,
                'blurb'=>$request->blurb,
                'story-flow'=>$request->storyFlow
            ]);
            DB::commit();
            return response()->json($story);
        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json('failed to create story');
        }
    }


// //commenting section
// public function __construct()
// {
//    $this->middleware('auth');
// }

public function index()
{
   $posts = Story::take(5)->get();

   return view('post.index', compact('posts'));
}

public function create()
{
    return view('post.create');
}

public function store(Request $request)
{

    $validator = Validator::make($request->all(), [
        'title' => 'required|min:3',
    ]);

    if ($validator->fails()) {

        return redirect('post')
                    ->withErrors($validator)
                    ->withInput();
    }

    Story::create([
        'title' => $request->title,
        'slug' => \Str::slug($request->title)
    ]);

    return redirect()->back();

}

public function show(Post $post) {

    return view('post.single',compact('post'));

}

/**
 * Get all the reviews of a story
 * 
 * @param int id
 * 
 * @return Illuminate\Http\Response
*/

public function getAllReviewsByStoryId($id)
{
    $response =[];
    try {
        $reviews = Story::where('id', $id)->with('reviews','reviews.user')->get();
        $response["reviews"] = $reviews;
        $response["code"] = 200;
    }catch(\Exception $e) {
        $response["errors"] = ["message"=> "Unable to retrieve Reviews $e"];
        $response["code"] = 400;
    }

    return response($response, $response["code"]);
}

}
