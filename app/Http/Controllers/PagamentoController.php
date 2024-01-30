<?php

namespace App\Http\Controllers;

use App\Http\Requests\pagamentoFormRequest;
use App\Models\Pagamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PagamentoController extends Controller
{
    public function store(pagamentoFormRequest $request)
    {
        $pagamento = Pagamento::create([
            'nome_pagamento' => $request->nome_pagamento,
            'taxa_pagamento' => $request->taxa_pagamento,
          'status_pagamento' => $request->status_pagamento,

        ]);

        return response()->json([
            "succes" => true,
            "message" => "Pagamento Cadastrado com sucesso",
            "data" => $pagamento
        ], 200);
    }
    public function excluir($id)
    {
        $pagamento = Pagamento::find($id);

        if (!isset($pagamento)) {
            return response()->json([
                'status' => false,
                'message' => "pagamento não encotrado"
            ]);
        }

        $pagamento->delete();

        return response()->json([
            'status' => true,
            'message' => "pagamento excluido com sucesso"
        ]);
    }
    public function esqueciSenha(Request $request)
    {
        $pagamento = Pagamento::where('cpf', '=', $request->cpf)->where('email', '=', $request->email)->first();

        if (isset($pagamento)) {
            $pagamento->senha = Hash::make($pagamento->senha);
            $pagamento->update();
            return response()->json([
                'status' => true,
                'message' => 'senha redefinida.'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'não foi possivel alterar a senha'
        ]);
    }
    public function update(Request $request)
    {
        $pagamento = Pagamento::find($request->id);

        if (!isset($pagamento)) {
            return response()->json([
                'status' => false,
                'message' => "Cadastro não encontrado"
            ]);
        }

        if (isset($request->nome)) {
            $pagamento->nome = $request->nome;
        }
        if (isset($request->taxa)) {
            $pagamento->taxa = $request->taxa;
        }
        if (isset($request->status)) {
            $pagamento->status = $request->status;
        }
        

        $pagamento->update();

        return response()->json([
            'status' => true,
            'message' => "Cadastro atualizado"
        ]);
    }
}
