<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    //
    public function index()
    {
        $clientes = Cliente::all()->toArray();

        //RETORNA OS CLIENTES COM A FUNÇÃO ARRAY_REVERSE COM A ENTRADA DO TIPO ARRAY E RETORNA UM NOVO ARRAY COM A ORDEM DOS ELEMENTOS INVERTIDA.
        // https://www.php.net/manual/pt_BR/function.array-reverse.php
        $clientesreverse = array_reverse($clientes);

        return response($clientesreverse, 200);
        // 200 | OK | = Resposta padrão para solicitações HTTP bem-sucedidas.
        // A resposta real dependerá do método de solicitação usado. Em uma solicitação GET, a resposta conterá uma entidade correspondente ao recurso solicitado.
        // Em uma solicitação POST, a resposta conterá uma entidade descrevendo ou contendo o resultado da ação.
    }
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            // DEIXEI APENAS O NOME PRA VALIDAÇÃO PRA FACILITAR NOS TESTES.
        ]);
        $cliente = new Cliente([
            'nome' => $request->input('nome'),
            'dataNascimento' => $request->input('dataNascimento'),
            'cpf' => $request->input('cpf'),
            'telefone' => $request->input('telefone'),
            'email' => $request->input('email'),
            'data_alt' => $request->input('data_alt'),
        ]);
        if ($cliente->save()) {
            return response()->json([
                "message" => "Cliente criado."
            ], 201); // 201 | Criado | = A solicitação foi atendida, resultando na criação de um novo recurso.
        }
    }
    public function show($id)
    {
        if (Cliente::where('id', $id)->exists()) {
            $cliente = Cliente::find($id);
            return response()->json($cliente, 200);
        } else {
            return response()->json([
                "message" => "Cliente não encontrado."
            ], 404); //404 | Não encontrado | = O recurso solicitado não foi encontrado, mas pode estar disponível no futuro. Solicitações subsequentes do cliente são permitidas.
        }
    }
    public function update($id, Request $request)
    {
        if (Cliente::where('id', $id)->exists()) {
            $cliente = Cliente::find($id);
            $cliente->update($request->all());
            return response()->json([
                "message" => "Cliente atualizado."
            ], 200);
        } else {
            return response()->json([
                "message" => "Cliente não encontrado."
            ], 404);
        }
    }
    public function destroy($id)
    {
        if (Cliente::where('id', $id)->exists()) {
            $cliente = Cliente::find($id);
            $cliente->delete();

            return response()->json([
                "message" => "Cliente deletado."
            ], 202);
        } else {
            return response()->json([
                "message" => "Cliente não encontrado."
            ], 404);
        }
    }
}
