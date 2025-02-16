<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MercadoLivreController;
use App\Http\Controllers\ProdutoController;


// Rotas do Mercado Livre
Route::get('/auth/mercado-livre', [MercadoLivreController::class, 'redirectToMercadoLivre']);
Route::get('/auth/mercado-livre/callback', [MercadoLivreController::class, 'handleMercadoLivreCallback']);

// Rotas de Produtos
Route::get('/produtos/cadastrar', [ProdutoController::class, 'create'])->name('produtos.create');
Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store');
Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
Route::get('/produtos/teste', [ProdutoController::class, 'enviarProdutoTeste']);
Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');

