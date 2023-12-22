<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediaController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum'])->get('api/user', function (Request $request) {
    $user = $request->user();
    $user->roles;
    return $user;
});

Route::get('/', [HomeController::class, 'home']);
Route::get('/admin', [HomeController::class, 'admin']);

//urls para documents e imagenes
Route::get('/img/{key}', [MediaController::class, 'getImage']);
Route::get('/docs/{key}', [MediaController::class, 'getDocument']);
