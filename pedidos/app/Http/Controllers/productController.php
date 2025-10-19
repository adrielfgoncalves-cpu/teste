<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_Product;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Else_;
use Symfony\Component\CssSelector\Node\ElementNode;
use App\Models\Product;

class productController extends Controller
{
    //
    public function index()
    {
        $products = Product::all();
        return view('product.index' , ['products' => $products]);
    }

    //pagina de novo produto
    public function add()
    {
        return view('product.add');
    }

    //pagina de edicao do produto
    public function edit($id)
    {
        $product = Product::Find($id);

        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Produto não encontrado.');
        }else{
            return view('product.edit', compact('product'));
        }
    }

    //adicionar novo produto
    public function store(Request $request)
    {
        //validar dados
        $this->validateProduct($request);
        try {
            Product::create($request->all());
            return redirect()->route('product.index')->with('success', 'Produto criado com sucesso.');
        } catch (\Exception $e) {

            return redirect()->route('product.index')->with('error', 'Erro ao criar produto.');
        }
    }


    //atualizar produto
    public function update(Request $request, $id)
    {
        //validar dados
        $this->validateProduct($request);
        try {
            $product = Product::find($id);
            if (!$product) {
                return redirect()->route('product.index')->with('error', 'Produto não encontrado.');
            }else
            {
                $product->update($request->all());
                return redirect()->route('product.index')->with('success', 'Produto atualizado com sucesso.');
            }
        } catch (\Exception $e) {
            return redirect()->route('product.index')->with('error', 'Erro ao atualizar produto.');
        }
    }

    //deletar produto
    public function destroy($id)
    {
        try {
            $product = Product::find($id);
            //verifica se o produto esta associado a algum pedido
            /* $ordersCount = Order::whereHas('products', function ($query) use ($id) {
                $query->where('produto_id', $id);
            })->count();
            //dd($teste); */
            $ordersCount = $product->orders()->count();

            if (!$product) {
                return redirect()->route('product.index')->with('error', 'Produto não encontrado.');
            }else if ($ordersCount > 0) {
                return redirect()->route('product.index')->with('error', 'Não é possível excluir o produto porque ele está associado a pedidos.');
            }else
            {
                $product->delete();
                return redirect()->route('product.index')->with('success', 'Produto excluído com sucesso.');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->route('product.index')->with('error', 'Erro ao excluir produto.');
        }
    }

    private function validateProduct(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
            'estoque' => 'required|integer|min:0',],[
                'nome.required' => 'O campo Nome é obrigatório.',
                'preco.required' => 'O campo Preço é obrigatório.',
                'preco.min' => 'O campo Preço deve ser no mínimo 0.',
                'estoque.required' => 'O campo Estoque é obrigatório.',
                'estoque.integer' => 'O campo Estoque deve ser um número inteiro.',
                'estoque.min' => 'O campo Estoque deve ser no mínimo 0.',
            ]
        );
    }
}
