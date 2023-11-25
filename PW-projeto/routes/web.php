<?php

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
    return view('welcome-pw');
})->name('inicio');

Route::get('/dashboard', \App\Http\Controllers\DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::resource('documents', DocumentController::class);
    Route::delete('/users/{user}/edit/{permission}', [UserController::class, 'destroyPermission'])->name('users.destroyPermission');
    Route::get('/users/{user}/edit/{permission}', [UserController::class, 'createPermission'])->name('users.createPermission');
    Route::get('/documents/create/upload', [DocumentController::class, 'upload'])->name('documents.upload');
    Route::delete('/documents/{document}/edit/{metadata}', [DocumentController::class, 'removeMetadata'])->name('documents.removeMetadata');
    Route::get('/documents/{document}/edit/{metadata}', [DocumentController::class, 'createMetadata'])->name('documents.createMetadata');


// Rotas para o histórico de revisões

Route::get('/documents/{document}/history', [DocumentController::class, 'showHistory'])->name('documents.history');

});

require __DIR__.'/auth.php';
