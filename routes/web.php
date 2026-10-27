<?php

use App\Http\Controllers\BiodataController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Halaman Home
Route::get('/home', [HomeController::class, 'index'])
    ->name('home');

// Halaman Form Pertanyaan
Route::get('/home-question', [QuestionController::class, 'create'])
    ->name('question.create');

// Proses pengiriman pertanyaan
Route::post('/question/store', [QuestionController::class, 'store'])
    ->name('question.store');

// Halaman respons pertanyaan
Route::get('/home-question-response', function () {
    return view('home-question-response');
})->name('question.response');

// Halaman Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

// CRUD Pelanggan
Route::resource('pelanggan', PelangganController::class);

// Halaman CV
Route::get('/cv', [BiodataController::class, 'index'])
    ->name('cv.index');

// CRUD Biodata
Route::resource('biodata', BiodataController::class);
