<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AdminAuth;

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
Route::post('/users/login', [UserController::class, 'login']);
Route::post('register',[UserController::class,'register']);
Route::post('add_story', [StoryController::class, 'storeStory']);
Route::get('search/{title}',[StoryController::class, 'searchStory']);
Route::get('search/{title}',[SearchController::class,'search']);
