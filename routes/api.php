<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CopyController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//bárki által elérhető
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

//autentikált útvonal
Route::middleware(['auth:sanctum'])
    ->group(function () {
        Route::get('/user-lendings-with-copies', [LendingController::class, 'userLendingsWithCopies']);
        Route::get('/lending-count', [LendingController::class, 'lendingCount']);
        Route::get('user-lendings', [LendingController::class, 'userLendings']);
        Route::get('/lending-book-count', [LendingController::class, 'lendingBookCount']);
        Route::get('/lending-count-with-me', [LendingController::class, 'lendingCountWithMe']);
        Route::get('/lending-count-with-me2', [LendingController::class, 'lendingCountWithMe2']);
        Route::get('/book-with-me', [LendingController::class, 'bookWithMe']);
        // Kijelentkezés útvonal
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
    });

Route::middleware(['auth:sanctum', Admin::class])
    ->group(function () {
        //Route::get('/admin/users', [UserController::class, 'index']);
        Route::apiResource('/admin/users', UserController::class);
        //lekérdezések
        Route::get('/lendings-with-copies', [LendingController::class, 'lendingsWithCopies']);
        Route::get('/books-with-copies', [BookController::class, 'booksWithCopies']);
        //date paraméter miatt kell
        Route::get('/lending-with-users/{date}', [LendingController::class, 'lendingWithUsers']);
        Route::get('/copy-with-lendings/{copy_id}', [CopyController::class, 'copyWithLendings']);
    });

Route::get('file-upload', [FileController::class, 'index']);
Route::post('file-upload', [FileController::class, 'store'])->name('file.store');
