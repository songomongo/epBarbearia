<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\ServicoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//servico
Route::post('store',[ServicoController::class,'store']);
Route::post('nome',[ServicoController::class, 'pesquisarPorNome']);
Route::post('descricao',[ServicoController::class, 'pesquisarPorDescricao']);
Route::delete('delete/{id}',[ServicoController::class, 'excluir']);
Route::put('update', [ServicoController::class, 'update']);

//cliente
Route::post('cadastro',[ClienteController::class,'store']);
Route::post('procurarN',[ClienteController::class, 'pesquisarPorNome']);
Route::post('procurarC',[ClienteController::class, 'pesquisarPorCpf']);
Route::post('procurarCE',[ClienteController::class, 'pesquisarPorCelular']);
Route::post('procurarE',[ClienteController::class, 'pesquisarPorEmail']);
Route::delete('excluir/{id}',[ClienteController::class, 'excluir']);
Route::put('atualizar', [ClienteController::class, 'update']);
Route::post('esqueciSenha',[ClienteController::class, 'esqueciSenha']);

//profissional
Route::post('cadastroProfissional',[ProfissionalController::class,'store']);
Route::post('procurarNProfissional',[ProfissionalController::class, 'pesquisarPorNome']);
Route::post('procurarCProfissional',[ProfissionalController::class, 'pesquisarPorCpf']);
Route::post('procurarCEProfissional',[ProfissionalController::class, 'pesquisarPorCelular']);
Route::post('procurarEProfissional',[ProfissionalController::class, 'pesquisarPorEmail']);
Route::delete('excluirProfissional/{id}',[ProfissionalController::class, 'excluir']);
Route::put('atualizarProfissional', [ProfissionalController::class, 'update']);