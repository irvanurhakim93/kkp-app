<?php

use App\Http\Controllers\Api\RegisterController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


// Route::post('/register', [RegisterController::class])->name('user.register');
Route::get('/register',[RegisterController::class,'index']);
Route::post('/registerprocess', App\Http\Controllers\Api\RegisterController::class)->name('register');
