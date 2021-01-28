<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// CUSTOMIZE CONTROLLERS
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\PublishedStoryController;
use App\Http\Controllers\user\UserLibraryController;
use App\Http\Controllers\user\UserHomeController;
use App\Http\Controllers\ReviewController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
});
         /* USER ROUTES */

//user register routes
Route::get('users', [UserController::class,'index']);
Route::get('register', [UserController::class, 'register_home']);
Route::post('register',[UserController::class,'register']);

//user log in routes
Route::get('login', [UserController::class, 'login_form']);
Route::post('login', [UserController::class, 'login']);

//logout route
Route::post('logout/{user}', [UserController::class, 'logout']);

//create story routes
Route::post('add_story/{user}', [StoryController::class, 'storeStory']);

//getallstory
Route::get('story', [UserHomeController::class, 'getStory']);

        /* USER LIBRARY */
Route::post('add_to_library/{publishedStory}/{reader_id}', [UserLibraryController::class,'addToLibrary']);
Route::delete('delete_from_library/{story}', [UserLibraryController::class, 'deleteFromLibrary']);
Route::get('library/{reader_id}', [UserLibraryController::class, 'getFromLibrary']);
Route::get('stories_in_library', [UserLibraryController::class, 'getallFromLibrary']);
// all published story
Route::get('published_story/{user}', [PublishedStoryController::class, 'userPublished']);
Route::delete('delete_published/{story}', [PublishedStoryController::class, 'deletePublished']);

        /* ADMIN ROUTES */
Route::get('dashboard/by_ratings',[AdminController::class, 'byRating']);
Route::get('dashboard', [AdminController::class, 'dashboard']);
Route::get('story_to_be_publish', [StoryController::class, 'getStory']);
Route::post('publish/{story}', [PublishedStoryController::class, 'storyToPublish']);
Route::post('decline/{story}', [AdminController::class, 'decline_story']);
Route::get('declined', [AdminController::class, 'getDeclined']);

        /* BOTH */

//search routes
Route::get('search/{title}',[SearchController::class,'search']);
Route::get('search/genre/{genre}', [SearchController::class, 'genre']);

// review route
Route::get('review', [ReviewController::class, 'getReview']);
Route::post('review', [ReviewController::class,'store'])->name('story.store');

//story(temporary_storage for story)
Route::get('get_story',[StoryController::class, 'getStory']);