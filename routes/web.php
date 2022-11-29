<?php

use App\Http\Controllers\FotoAlbumController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('home');
});

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/fotoalbums', [FotoAlbumController::class, 'show'])->name('fotoalbums.show');
Route::get('/fotoalbum/{fotoalbum}', [FotoAlbumController::class, 'showOne'])->name('fotoalbums.showOne');
Route::middleware(['admin'])->group(function () {
    Route::post('/fotoalbum/create', [FotoAlbumController::class, 'create'])->name('fotoalbums.create');
    Route::post('/fa', [FotoAlbumController::class, 'store'])->name('fotoalbums.store');
    Route::get('/fotoalbum/edit/{fotoalbum}', [FotoAlbumController::class, 'edit'])->name('fotoalbums.edit');
    Route::get('/fau/{fotoalbum}', [FotoAlbumController::class, 'update'])->name('fotoalbums.update');
    Route::get('/fotoalbum/delete/{fotoalbum}', [FotoAlbumController::class, 'delete'])->name('fotoalbums.delete');

    Route::get('/foto/{fotoalbum}/create', [FotoController::class, 'index'])->name('fotos.index');
    Route::post('/fc/{fotoalbum}', [FotoController::class, 'store'])->name('fotos.store');

    Route::get('/foto/edit/{foto}', [FotoController::class, 'editShow'])->name('fotos.editShow');
    Route::get('/fu/{foto}', [FotoController::class, 'update'])->name('fotos.update');
    Route::get('/foto/delete/{foto}', [FotoController::class, 'delete'])->name('fotos.delete');
});
