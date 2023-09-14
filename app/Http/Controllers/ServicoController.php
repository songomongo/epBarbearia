<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServicoFormRequest;
use App\Models\servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function store(ServicoFormRequest $request){
        $usuario = servico::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'duracao'=>$request->duracao,
            'preco'=>$request->preco,
        ]);

        return response()->json([
            "succes" => true,
            "message" =>"Usuario Cadastrado com sucesso",
            "data" => $usuario
        ],200);
    }

    public function pesquisarPorNome(Request $request){
        $usuarios = Servico::where('nome', 'like', '%'. $request->nome . '%')->get();
    
        if(count($usuarios)>0){
            return response()->json([
                'status'=>true,
                'data'=> $usuarios
            ]);
        }
        
        return response()->json([
            'status'=>false,
             'data'=> 'Não há resultados para a pesquisa.'
            ]);
    
    }


    public function pesquisarPorDescricao(Request $request){
        $usuarios = servico::where('descricao', 'like', '%'. $request->descricao . '%')->get();
    
        if(count($usuarios)>0){
            return response()->json([
                'status'=>true,
                'data'=> $usuarios
            ]);
        }
        
        return response()->json([
            'status'=>false,
             'data'=> 'Não há resultados para a pesquisa.'
            ]);
    
    }

    public function update(Request $request){
        $usuario = servico::find($request->id);
    
        if(!isset($usuario)){
            return response()->json([
                'status' => false,
                'message' => "Cadastro não encontrado"
            ]);
        }
    
        if(isset($request->nome)){
            $usuario->nome = $request->nome;
        }
        if(isset($request->descricao)){
            $usuario->descricao= $request->descricao;
        }
        if(isset($request->duracao)){
            $usuario->duracao = $request->duracao;
        }
        if(isset($request->preco)){
            $usuario->preco = $request->preco;
        }
    
        $usuario-> update();
    
        return response()->json([
            'status' => true,
            'message' => "Cadastro atualizado"
        ]);
    
    }

    public function excluir($id){
        $usuario = servico::find($id);
    
        if(!isset($usuario)){
            return response()->json([
                'status' => false,
                'message' => "Cadastro não encotrado"
            ]);
        }
    
        $usuario->delete();
    
        return response()->json([
            'status' => true,
            'message' => "Cadastro excluido com sucesso"
        ]);
    }

  
}
