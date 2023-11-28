<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PDFController;


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
    return view('welcome');
});

Auth::routes();

Route::resource('proyectos', ProyectoController::class);
Route::resource('materias', MateriaController::class);

//pdf
Route::get('/proyectos/pdf', [ProyectoController::class, 'generatePDF'])->name('proyectos.pdf')->middleware('auth');
Route::get('/generate-pdf', [PDFController::class, 'generatePDF'])->name('generate.pdf')->middleware('auth');

Route::get('/home', [HomeController::class, 'index'])->name('home');
