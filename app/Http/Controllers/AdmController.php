<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdmRequest;
use App\Models\Adm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class AdmController extends Controller
{
    public function store(AdmRequest $request)
    {
        $Adms = Adm::create([
            'nome' => $request->nome,
            'celular' => $request->celular,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'dataNascimento' => $request->dataNascimento,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
            'pais' => $request->pais,
            'rua' => $request->rua,
            'numero' => $request->numero,
            'bairro' => $request->bairro,
            'cep' => $request->cep,
            'complemento' => $request->complemento,
            'senha' => Hash::make($request->senha),

        ]);

        return response()->json([
            "success" => true,
            "message" => "Adm Cadastrado com sucesso",
            "data" => $Adms
        ], 200);
    }

    public function retornarTodos()
    {
        $Adms = Adm::all();
        return response()->json([
            'status' => true,
            'data' => $Adms
        ]);
    }

    public function pesquisarPorId($id)
    {
        $Adms = Adm::find($id);

        if ($Adms == null) {
            return response()->json([
                'status' => false,
                'message' => "Adm não encontrado"
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $Adms
        ]);
    }

    public function pesquisarPorNome(Request $request)
    {
        $Adms = Adm::where('nome', 'like', '%' . $request->nome . '%')->get();

        if (count($Adms) > 0) {
            return response()->json([
                'status' => true,
                'data' => $Adms
            ]);
        }

        return response()->json([
            'status' => false,
            'data' => 'Não há resultados para a pesquisa.'
        ]);
    }


    public function pesquisarPorCpf(Request $request)
    {
        $Adms = Adm::where('cpf', 'like', '%' . $request->cpf . '%')->get();

        if (count($Adms) > 0) {
            return response()->json([
                'status' => true,
                'data' => $Adms
            ]);
        }

        return response()->json([
            'status' => false,
            'data' => 'Não há resultados para a pesquisa.'
        ]);
    }

    public function pesquisarPorCelular(Request $request)
    {
        $Adms = Adm::where('celular', 'like', '%' . $request->celular . '%')->get();

        if (count($Adms) > 0) {
            return response()->json([
                'status' => true,
                'data' => $Adms
            ]);
        }

        return response()->json([
            'status' => false,
            'data' => 'Não há resultados para a pesquisa.'
        ]);
    }


    public function pesquisarPorEmail(Request $request)
    {
        $Adms = Adm::where('email', 'like', '%' . $request->email . '%')->get();

        if (count($Adms) > 0) {
            return response()->json([
                'status' => true,
                'data' => $Adms
            ]);
        }

        return response()->json([
            'status' => false,
            'data' => 'Não há resultados para a pesquisa.'
        ]);
    }


    public function update(Request $request)
    {
        $Adms = Adm::find($request->id);

        if (!isset($Adms)) {
            return response()->json([
                'status' => false,
                'message' => "Cadastro não encontrado"
            ]);
        }

        if (isset($request->nome)) {
            $Adms->nome = $request->nome;
        }
        if (isset($request->celular)) {
            $Adms->celular = $request->celular;
        }
        if (isset($request->email)) {
            $Adms->email = $request->email;
        }
        if (isset($request->cpf)) {
            $Adms->cpf = $request->cpf;
        }
        if (isset($request->dataNascimento)) {
            $Adms->dataNascimento = $request->dataNascimento;
        }
        if (isset($request->cidade)) {
            $Adms->cidade = $request->cidade;
        }
        if (isset($request->estado)) {
            $Adms->estado = $request->estado;
        }
        if (isset($request->pais)) {
            $Adms->pais = $request->pais;
        }
        if (isset($request->rua)) {
            $Adms->rua = $request->rua;
        }
        if (isset($request->numero)) {
            $Adms->numero = $request->numero;
        }
        if (isset($request->bairro)) {
            $Adms->bairro = $request->bairro;
        }
        if (isset($request->cep)) {
            $Adms->cep = $request->cep;
        }
        if (isset($request->complemento)) {
            $Adms->complemento = $request->complemento;
        }
        if (isset($request->senha)) {
            $Adms->senha = $request->senha;
        }

        $Adms->update();

        return response()->json([
            'status' => true,
            'message' => "Cadastro atualizado"
        ]);
    }


    public function excluir($id)
    {
        $Adms = Adm::find($id);

        if (!isset($Adms)) {
            return response()->json([
                'status' => false,
                'message' => "Cadastro não encotrado"
            ]);
        }

        $Adms->delete();

        return response()->json([
            'status' => true,
            'message' => "Cadastro excluido com sucesso"
        ]);
    }

    public function exportarCsv()
    {
        $Adms = Adm::all();

        $nomeArquivo = 'Adm.csv';

        $filePath = storage_path('app/public/' . $nomeArquivo);

        $handle = fopen($filePath, "w");

        fputcsv($handle, array('nome', 'E-mail', 'cpf', 'celular',), ';');

        foreach ($Adms as $u) {
            fputcsv($handle, array(
                $u->nome,
                $u->email,
                $u->cpf,
                $u->celular,

            ), ';');
        }

        fclose($handle);

        return Response::download(public_path() . '/storage/' . $nomeArquivo)
            ->deleteFileAfterSend(true);
    }

    public function esqueciSenhaAdm(Request $request)
    {
        $Adms = Adm::where('cpf', $request->cpf)->where('email', $request->email)->first();

        if (isset($Adms)) {
            $Adms->senha = Hash::make($Adms->senha);
            $Adms->update();
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
}
