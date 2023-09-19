<?php

use App\Http\Controllers\ClienteController;
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
Route::post('store',[ClienteController::class,'store']);
Route::post('nome',[ClienteController::class, 'pesquisarPorNome']);
Route::post('cpf',[ClienteController::class, 'pesquisarPorCpf']);
Route::post('celular',[ClienteController::class, 'pesquisarPorCelular']);
Route::post('email',[ClienteController::class, 'pesquisarPorEmail']);
Route::delete('delete/{id}',[ClienteController::class, 'excluir']);
Route::put('update', [ClienteController::class, 'update']);
Route::post('esqueciSenha',[ClienteController::class, 'esqueciSenha']);
