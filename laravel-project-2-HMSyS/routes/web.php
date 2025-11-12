<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;

Route::get('/', [AdminController::class, 'home']);



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

Route::get('/home', [AdminController::class, 'index']);
Route::get('/create_room', [AdminController::class, 'create_room']);

Route::post('/add_room', [AdminController::class, 'add_room']);
