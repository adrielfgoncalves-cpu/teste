<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use Exception;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //retorna todos os produtos com paginação
        $curentPage = $request->get('current_page') ?? 1;
        $regPerPage = 2;
        $skip = ($curentPage - 1) * $regPerPage;

        //faz a paginação e busca 2 registros por vez
        $products = Product::skip($skip)->take($regPerPage)->orderByDesc('id')->get();
        //dd($products);


        return response()->json($products, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
   /*  public function store(Request $request)
    {
        //
    } */

    //cria a função store para salvar um novo produto

    public function store(Request $request)
    {
        $data = $request->all();

        try{
            $product = new Product();
            $product->fill($data);
            $product->save();
            return response()->json($product, 201);
        } catch (Exception $e) {
            return response()->json([
                "message" => "Erro ao cadastrar produto",
            ], 404);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $product = Product::find($id);
        if ($product){
            return response()->json($product, 201);
        } else{
            return response()->json([
                "message" => "Produto não encontrado",
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();

        try{
            $product = Product::find($id);
            //valida se o produto existe
            if($product){
                $product->update($data);
                return response()->json($product, 200);
            }else{
                return response()->json([
                    "message" => "Produto nao existe",
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                "message" => "Erro ao atualizar produto",
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // verifica se o produto existe
        try{
            $product = Product::find($id);

            //verifica se o produto existe
            if (!$product){
                return response()->json([
                    "message" => "Produto nao existe",
                ], 404);
            }

            $orderCount = $product->orders()->count();

            dd($orderCount);
            //verifica se ha pedidos do produto
            if ($orderCount > 0){
                //se houver pedidos, nao deixa excluir
                 return response()->json([
                "message" => "Não é possivel excluir o produto pois ele possui pedidos",
            ], 404);
            } else {
                // se nao houver pedidos, exclui o produto
                $product->destroy($id);
                return response()->json($product, 200);
            }
        } catch (Exception $e) {
            // caso nao exista, retorna a mensagem
            return response()->json([
                "message" => "Erro ao excluir produto",
            ], 404);
        }
    }
}
