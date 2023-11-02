<?php

use App\Http\Controllers\testupload;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('dashboard');
// });

Route::get('/', [ApiController::class, 'dashboard']);

Route::get('/search', [ApiController::class, 'search'])->name('search');

Route::post('/tambah-berkas', [ApiController::class, 'upload']);

Route::get('/detail/{id}', [ApiController::class, 'detail']);

Route::post('/disposisi', [ApiController::class, 'disposisi']);

Route::get('/paginate', [ApiController::class, 'paginate']);

// test
Route::get('/tes', [testupload::class, 'show']);
Route::post('/test', [testupload::class, 'upload']);

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
