<?php

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

Route::prefix('materials')->group(function () {
    Route::delete('/multiple', [App\Http\Controllers\MaterialController::class, 'destroyMultiple']);
});
Route::resource('materials', App\Http\Controllers\MaterialController::class);

// antireflectives
Route::prefix('antireflectives')->group(function () {
    Route::delete('/multiple', [App\Http\Controllers\AntireflectiveController::class, 'destroyMultiple']);
});
Route::resource('antireflectives', App\Http\Controllers\AntireflectiveController::class);

// 
Route::prefix('opticians')->group(function () {
    Route::delete('/multiple', [App\Http\Controllers\OpticianController::class, 'destroyMultiple']);
});
Route::resource('opticians', App\Http\Controllers\OpticianController::class);

Route::post('/newsletter', [App\Http\Controllers\NewsletterController::class, 'store']);
