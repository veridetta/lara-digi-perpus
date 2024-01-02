<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\UserController;
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

Route::get('/', [AuthController::class, 'auth'])->name('home');
//dummy
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/home', [AuthController::class, 'auth'])->name('home');
//middleware admin prefix
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('delete');
        Route::get('/data', [CategoryController::class, 'getData'])->name('data');
    });
    //route book
    Route::get('/book', [BookController::class, 'index'])->name('book');
    Route::prefix('book')->name('book.')->group(function () {
        Route::get('/create', [BookController::class, 'create'])->name('create');
        Route::post('/store', [BookController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BookController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [BookController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [BookController::class, 'delete'])->name('delete');
        Route::get('/data', [BookController::class, 'getData'])->name('data');
        Route::get('/show/{id}', [BookController::class, 'show'])->name('show');
        Route::get('/categories', [BookController::class, 'getCategories'])->name('categories');
        //export
        Route::get('/export', [BookController::class, 'export'])->name('export');
    });

});
Route::prefix('user')->name('user.')->middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
});
