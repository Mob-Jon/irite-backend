<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
// use App\Http\Controllers\AdminAuth;
// use App\Http\Controllers\CheckAge;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/users/login', [UserController::class, 'login']);
Route::post('register',[UserController::class,'register']);
Route::post('admin/register',[UserController::class,'adminRegister']);
Route::post('add_story', [StoryController::class, 'storeStory']);
Route::get('search/{title}',[SearchController::class,'search']);
Route::get('topStories',[HomeController::class,'index']);
// Route::post('review',[ReviewControler::class],'reviews');

//test
Route::get('/get-reviews/{id}', [StoryController::class, 'getAllReviewsByStoryId']);


//Commenting system routes
// Route::get('story', 'StoryController@create')->name('story.create');
Route::post('review', [ReviewController::class,'store'])->name('story.store');
// Route::get('/story', 'StoryController@index')->name('story');
// Route::get('/article/{story:slug}', 'StoryController@show')->name('story.show');
// Route::post('/review/store', 'ReviewController@store')->name('review.add');
// Route::post('/reply/store', 'ReviewController@replyStore')->name('reply.add');