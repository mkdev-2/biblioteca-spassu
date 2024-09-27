<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\AssuntoController;
use App\Http\Controllers\RelatorioController;

Route::resource('livros', LivroController::class);

Route::get('relatorios', [RelatorioController::class, 'index'])->name('relatorios.index');
Route::get('relatorios/visualizar', [RelatorioController::class, 'visualizarRelatorio'])->name('relatorios.visualizar');
Route::get('relatorios/gerar', [RelatorioController::class, 'gerarRelatorio'])->name('relatorios.gerar');


Route::resource('autores', AutorController::class)->parameters([
    'autores' => 'autor', 
]);

Route::resource('assuntos', AssuntoController::class);


Route::get('/', function () {
    return view('home', ['isHome' => true]);
});

