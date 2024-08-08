<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\TrackController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::resource('/student',StudentController::class);
Route::get('/tracks',[TrackController::class,'index'])->name('tracks.index');
Route::get('/tracks/create',[TrackController::class,'create']);
Route::post('/tracks',[TrackController::class,'store'])->name('tracks.store');
Route::get('/tracks/{id}',[TrackController::class,'show'])->name('track.view');
Route::get('tracks/{id}/edit',[TrackController::class,'edit'])->name('track.edit');
Route::put('/tracks/{id}', [TrackController::class, 'update'])->name('track.update');
Route::delete('tracks/{id}',[TrackController::class,'destroy'])->name('track.destroy');

