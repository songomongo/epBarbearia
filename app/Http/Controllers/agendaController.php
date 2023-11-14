<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgendaFormRequest;
use App\Models\Agenda;
use Illuminate\Http\Request;

class agendaController extends Controller
{
    public function store(AgendaFormRequest $request){
        $agendas = Agenda::create([
            'profissional_id' => $request->profissional_id,
            'agenda_id' => $request->agenda_id,
            'servico_id'=>$request->agenda_id,
            'data_hora'=>$request->data_hora,
            'tipo_pagamento'=>$request->tipo_pagamento,
            'valor'=>$request->valor,
          
            
        ]);  
       
        return response()->json([
            "success" => true,
            "message" =>"Agenda Cadastrado com sucesso",
            "data" => $agendas
        ],200);
    }

    public function pesquisarPorNome(Request $request){
        $agendas = Agenda::where('agenda_id', 'like', '%'. $request->agenda_id . '%')->get();
    
        if(count($agendas)>0){
            return response()->json([
                'status'=>true,
                'data'=> $agendas
            ]);
        }
        
        return response()->json([
            'status'=>false,
             'data'=> 'Não há resultados para a pesquisa.'
            ]);
    
    }

    
    public function pesquisarPorData(Request $request){
        $agendas = Agenda::where('data_hora', 'like', '%'. $request->data_hora . '%')->get();
    
        if(count($agendas)>0){
            return response()->json([
                'status'=>true,
                'data'=> $agendas
            ]);
        }
        
        return response()->json([
            'status'=>false,
             'data'=> 'Não há resultados para a pesquisa.'
            ]);
    
    }

    public function excluir($id){
        $agenda = Agenda::find($id);
    
        if(!isset($agenda)){
            return response()->json([
                'status' => false,
                'message' => "Cadastro não encotrado"
            ]);
        }
    
        $agenda->delete();
    
        return response()->json([
            'status' => true,
            'message' => "Cadastro excluido com sucesso"
        ]);
    }

    public function update(Request $request){
        $agendas = agenda::find($request->id);
    
        if(!isset($agendas)){
            return response()->json([
                'status' => false,
                'message' => "Cadastro não encontrado"
            ]);
        }
    
        if(isset($request->profissional_id)){
            $agendas->profissional_id = $request->nome;
        }
        if(isset($request->descricao)){
            $agendas->descricao= $request->descricao;
        }
        if(isset($request->duracao)){
            $agendas->duracao = $request->duracao;
        }
        if(isset($request->preco)){
            $agendas->preco = $request->preco;
        }
    
        $agendas-> update();
    
        return response()->json([
            'status' => true,
            'message' => "Cadastro atualizado"
        ]);
    
    }
}
