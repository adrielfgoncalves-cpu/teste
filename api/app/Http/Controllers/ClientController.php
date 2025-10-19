<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //retona todos os clientes com paginação

        $curentPage = $request->get('current_page') ?? 1;
        $regPerPage = 2;
        $skip = ($curentPage - 1) * $regPerPage;

        //faz a paginação e busca 2 registros por vez
        $clientes = Client::skip($skip)->take($regPerPage)->orderByDesc('id')->get();
        return response()->json($clientes, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        $data = $request->validated();

        try{
            $client = new Client();
            $client->fill($data);
            $client->save();
            return response()->json($client, 201);
        } catch (Exception $e) {
            return response()->json([
                "message" => "Erro ao cadastrar cliente",
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Client::find($id);

        if ($client){
            return response()->json($client, 201);
        } else{
            return response()->json([
                "message" => "Cliente nao existe",
            ], 404);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, string $id)
    {
        $data = $request->validated();

        try{
            $client = Client::find($id);
            //valida se o cliente existe
            if($client){
                $client->update($data);
                return response()->json($client, 200);
            }else{
                // caso nao existe, retorna a mensagem
                return response()->json([
                "message" => "O cliente que você esta tentando atualizar não existe",
            ], 404);
            }


        } catch (Exception $e) {
            return response()->json([
                "message" => "Erro ao atualizar cliente",
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        // verifica se o cliente existe
        try{
            $client = Client::findOrfail($id);

            //verifica se o cliente existe
            if (!$client){
                return response()->json([
                    "message" => "Cliente nao existe",
                ], 404);
            }

            $clientCount = $client->orders()->count();

            //verifica se ha pedidos do cliente
            if ($clientCount > 0){
                //se houver pedidos, nao deixa excluir
                 return response()->json([
                "message" => "Não é possivel excluir o cliente pois ele possui pedidos",
            ], 404);
            } else {
                // se nao houver pedidos, exclui o cliente
                $client->destroy($id);
                return response()->json($client, 200);
            }

        } catch (Exception $e) {
            // caso nao exista, retorna a mensagem
            return response()->json([
                "message" => "Erro ao atualizar cliente",
            ], 404);
        }
    }
}
