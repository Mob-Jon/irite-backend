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
// Route::get('story', [StoryController::class, 'getStory']);

        /* USER LIBRARY */
Route::post('add_to_library/{publishedStory}', [UserLibraryController::class,'addToLibrary']);
Route::delete('delete_from_library/{story}', [UserLibraryController::class, 'deleteFromLibrary']);

        /* ADMIN ROUTES */
Route::get('dashboard/by_ratings',[AdminController::class, 'byRating']);
Route::get('dashboard', [AdminController::class, 'dashboard']);
Route::post('publish/{story}', [PublishedStoryController::class, 'storyToPublish']);
        
        /* BOTH */

//search routes
Route::get('search/{title}',[SearchController::class,'search']);
Route::get('search/genre/{genre}', [SearchController::class, 'genre']);

// review route
Route::get('review', [ReviewController::class, 'getReview']);
Route::post('review', [ReviewController::class,'store'])->name('story.store');