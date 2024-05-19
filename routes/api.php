<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

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

//auth controller routes for login and logout
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// route to save user details
Route::post('/register', [UserController::class, 'store']);

// route to get all posts
Route::get('/home', [PostController::class, 'index']);

// route to get a post by id
Route::get('/show/{id}', [PostController::class, 'show']);

// route to save post details
Route::post('/create', [PostController::class, 'store']);

// route to edit post details by id
Route::put('/update/{id}', [PostController::class, 'update']);

// route to deelte post by id
Route::delete('/delete/{id}', [PostController::class, 'destroy']);
