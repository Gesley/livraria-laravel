<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AutorController;
use App\Http\Controllers\AssuntoController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\RelatorioController;

Route::get('/', function () {
    return redirect()->route('livros.index'); // Redireciona para a rota de livros
});


Route::resource('autores', AutorController::class);
Route::resource('assuntos', AssuntoController::class);
Route::resource('livros', LivroController::class);



Route::get('/relatorio', [RelatorioController::class, 'index'])->name('relatorio.index');
Route::get('/relatorio/export', [RelatorioController::class, 'export'])->name('relatorio.export');
Route::get('/relatorio/export-pdf', [RelatorioController::class, 'exportPDF'])->name('relatorio.exportPDF'); // Adiciona esta linha
Route::get('/relatorio/graficos', [RelatorioController::class, 'graficos'])->name('relatorio.graficos');






require __DIR__.'/auth.php';



