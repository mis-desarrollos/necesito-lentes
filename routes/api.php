<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    $user = $request->user();
    $user->roles;
    return $user;
});

//armazones
Route::prefix('frames')->group(function () {
    Route::delete('/multiple', [App\Http\Controllers\FrameController::class, 'destroyMultiple']);
});
Route::resource('frames', App\Http\Controllers\FrameController::class);

// armazones
Route::prefix('materials')->group(function () {
    Route::delete('/multiple', [App\Http\Controllers\MaterialController::class, 'destroyMultiple']);
});
Route::resource('materials', App\Http\Controllers\MaterialController::class);

// antireflectives
Route::prefix('antireflectives')->group(function () {
    Route::delete('/multiple', [App\Http\Controllers\AntireflectiveController::class, 'destroyMultiple']);
});
Route::resource('antireflectives', App\Http\Controllers\AntireflectiveController::class);


Route::post('/newsletter', [App\Http\Controllers\NewsletterController::class, 'store']);