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
Route::get('/create_room', [AdminController::class, 'create_room'])->name('create_room');
Route::get('/view_room', [AdminController::class, 'view_room'])->name('view_room');
Route::get('/get_room/{id}', [AdminController::class, 'get_room'])->name('get_room');
Route::post('/update_room/{id}', [AdminController::class, 'update_room'])->name('update_room');
Route::delete('/delete_room/{id}', [AdminController::class, 'delete_room'])->name('delete_room');

Route::post('/add_room', [AdminController::class, 'add_room']);
