<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SearchController;
 
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

Route::post('register',[RegisterController::class,'register']);
Route::post('adminHome',[AdminController::class,'register_admin']);
Route::get('search/{title}',[SearchController::class,'search']);

// Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function(){
//     //All the admin routes will be defined here...
//   });
