<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Product;
use App\Models\Order_Product;

class orderController extends Controller
{
    //pagina inicial de pedidos
   public function index()
    {
        //obter todos os pedidos
        $orders = Order::with('products', 'client')->get();    
        //dd($orders);  
        return view('order.index', ['orders' => $orders]);
    }

    //pagina para addicionar novo pedido
    public function add()
    {
        $clients = Client::all();
        $products = Product::all();
        return view('order.add', compact('clients', 'products'));
    }

    //adicionar novo pedido
    //adiciona um produto por pedido 
    //para adicionar mais produtos por pedido, sera necessario implementar de outra forma
    public function store(Request $request)
    {
         //dd($request->total);
        try {
            $order = new Order();
            $order->cliente_id = $request->client_id;
            $order->total = $this->formatDecimal($request->total);
            $order->data_pedido = now()->format('Y-m-d');
            $order->save();

            $order->products()->attach($request->product_id, [
                'quantidade' => $request->quantidade,
                'preco_unitario' => $this->formatDecimal($request->preco_unitario),
                'preco_total' => $this->formatDecimal($request->total),
            ]);
           
           // $order->save();

            return redirect()->route('order.index')->with('success', 'Pedido criado com sucesso.');  
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->route('order.index')->with('error', 'Erro ao criar pedido.');   
        }   
    }

    private function validateOrder(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clients,id',
            'total' => 'required|numeric|min:0',
            'data_pedido' => 'required|date',],
            [
               
                'cliente_id.exists' => 'O cliente selecionado não existe.',
                'total.required' => 'O campo Total é obrigatório.',
                'total.numeric' => 'O campo Total deve ser um número.',
                'total.min' => 'O campo Total deve ser no mínimo 0.',
                'data_pedido.required' => 'O campo Data do Pedido é obrigatório.',
                'data_pedido.date' => 'O campo Data do Pedido deve ser uma data válida.',
               ]
        );
    }   

    //formatar valor para decimal
    private function formatDecimal($value)
    {
        $total = str_replace('.', '', $value);
        $total = str_replace(',', '.', $total);

        // Converter para float
        $total = (float) $total;
        return $total;
    }
}
