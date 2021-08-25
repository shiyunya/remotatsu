<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\LotteryController;
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

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->get('/tasks', [TaskController::class, 'getTasks']);
Route::middleware('auth:sanctum')->post('/admin/task', [TaskController::class, 'postTask']);
Route::middleware('auth:sanctum')->put('/achievements', [AchievementController::class, 'putAchievements']);

Route::middleware('auth:sanctum')->get('/user/lottery', [LotteryController::class, 'user_status']);
Route::middleware('auth:sanctum')->post('/vote', [LotteryController::class, 'vote']);
Route::middleware('auth:sanctum')->get('/winner', [LotteryController::class, 'get_winner']);
