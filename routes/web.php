<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->name('authors.')->group(function () {
    Route::resource('authors', AuthorController::class)->names([
        'index' => 'index',
        'store' => 'store',
        'update' => 'update',
        'destroy' => 'destroy',
    ]);
});

Route::middleware(['auth', 'verified'])->name('books.')->group(function () {
    Route::resource('books', BookController::class)->names([
        'index' => 'index',
        'store' => 'store',
        'update' => 'update',
        'destroy' => 'destroy',
    ]);
});

require __DIR__ . '/auth.php';
