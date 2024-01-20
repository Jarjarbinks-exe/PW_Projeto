<?php

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Livewire\Documents\DocumentIndexLivewire;
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
    Route::resource('users', \App\Http\Controllers\UserController::class)
    ->except(['index']);
    Route::get('users', \App\Livewire\Users\UserIndexLivewire::class)
        ->name('users.index');
    Route::resource('documents', \App\Http\Controllers\DocumentController::class)
        ->except(['index']);
    Route::get('/documents', \App\Livewire\Documents\DocumentIndexLivewire::class)
        ->name('documents.index');
    Route::delete('/users/{user}/edit/{permission}', [UserController::class, 'destroyPermission'])->name('users.destroyPermission');
    Route::get('/users/{user}/edit/{permission}', [UserController::class, 'createPermission'])->name('users.createPermission');
    Route::get('/users/{user}/edit/department/{department}', [UserController::class, 'createDepartment'])->name('users.createDepartment');
    Route::delete('/users/{user}/edit/department/{department}', [UserController::class, 'removeDepartment'])->name('users.removeDepartment');
    Route::put('/users/{user}/edit', [UserController::class, 'update'])->name('users.update');
    Route::get('/documents/create/upload', [DocumentController::class, 'upload'])->name('documents.upload');
    Route::delete('/documents/{document}/edit/{metadata}', [DocumentController::class, 'removeMetadata'])->name('documents.removeMetadata');
    Route::get('/documents/{document}/edit/{metadata}', [DocumentController::class, 'createMetadata'])->name('documents.createMetadata');
    Route::get('/documents/{document}/edit/permission/{permission}', [DocumentController::class, 'createPermission'])->name('documents.createPermission');
    Route::delete('/documents/{document}/edit/permission/{permission}', [DocumentController::class, 'removePermission'])->name('documents.removePermission');
    Route::delete('/documents/{document}/edit/category/{category}', [DocumentController::class, 'removeCategory'])->name('documents.removeCategory');
    Route::get('/documents/{document}/edit/category/{category}', [DocumentController::class, 'createCategory'])->name('documents.createCategory');
    Route::get('/documents/{document}/download/', [DocumentController::class, 'download'])->name('documents.download');
    Route::get('/documents/{document}/sendEmail', [DocumentController::class, 'sendEmail'])->name('documents.sendEmail');
    Route::get('/documents/{document}/verify', [DocumentController::class, 'password'])->name('documents.password');
    Route::put('/users/{user}/edit', [UserController::class, 'update'])->name('users.update');
// Rotas para o histórico de revisões
Route::get('/documents/{document}/history', [DocumentController::class, 'showHistory'])->name('documents.history');

});


require __DIR__.'/auth.php';
