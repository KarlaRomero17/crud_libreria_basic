<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\CategoriaController;
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

//Route::get('/', function () {return view('welcome');});
Route::get('/', function () {return view('home');});

Auth::routes();
//ruta personalizada
Route::get('/home', [HomeController::class, 'index'])->name('home');
//ruta senccilla
//Route::resource('libros', App\Http\Controllers\LibroController::class);
//Route::resource('categorias', App\Http\Controllers\CategoriaController::class);


//CATEGORIA
//Route::get('categorias', [CategoriaController::class, 'index'])->name('categorias');
//new form
/*Route::get('create', [CategoriaController::class, 'create'])->name('categorias.create')->middleware('auth');
Route::post('stores', [CategoriaController::class, 'store'])->name('categorias.stores')->middleware('auth');
Route::get('showcategory/{id}', [CategoriaController::class, 'show'])->name('categorias.showcategory')->middleware('auth');
Route::put('update/{id}', [CategoriaController::class, 'update'])->name('categorias.update')->middleware('auth');
Route::delete('destroy/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy')->middleware('auth');
Route::get('editar/{id}', [CategoriaController::class, 'edit'])->name('categorias.editar');
*/
Route::controller(CategoriaController::class)->group(function () {
    Route::get('/categorias', 'index')->name('categorias')->middleware('auth');
    Route::get('categorias/create', 'create')->name('categorias.create')->middleware('auth');
    Route::post('categorias/stores', 'store')->name('categorias.stores')->middleware('auth');
    Route::get('categorias/showcategory/{id}', 'show')->name('categorias.showcategory')->middleware('auth');
    Route::put('categorias/update/{id}', 'update')->name('categorias.update')->middleware('auth');
    Route::delete('categorias/destroy/{id}', 'destroy')->name('categorias.destroy')->middleware('auth');
    Route::get('categorias/editar/{id}', 'edit')->name('categorias.editar')->middleware('auth');
});

//  LIBROS
Route::get('libros', [LibroController::class, 'index'])->name('libros')->middleware('auth');
Route::get('libros/createbook', [LibroController::class, 'create'])->name('libros.createbook')->middleware('auth');
Route::post('libros/storebook', [LibroController::class, 'store'])->name('libros.storebook')->middleware('auth');
Route::get('libros/showbook/{id}', [LibroController::class, 'show'])->name('libros.showbook')->middleware('auth');
Route::get('libros/editbook/{id}', [LibroController::class, 'edit'])->name('libros.editbook')->middleware('auth');
Route::put('libros/updatebook/{id}', [LibroController::class, 'update'])->name('libros.update')->middleware('auth');
Route::delete('libros/destroybook/{id}', [LibroController::class, 'destroy'])->name('libros.destroybook')->middleware('auth');
Route::get('libros/createbook', [LibroController::class, 'create'])->name('libros.createbook')->middleware('auth');
Route::get('libros/pdf', [LibroController::class, 'pdf'])->name('libros.pdf')->middleware('auth');
Route::get('libros/pdflibro/{id}', [LibroController::class, 'pdflibro'])->name('libros.pdflibro')->middleware('auth');
Route::get('libros/export', [LibroController::class, 'export'])->name('libros.export')->middleware('auth');