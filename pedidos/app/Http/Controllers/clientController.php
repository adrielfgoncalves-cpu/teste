<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\Order;
use Illuminate\Http\Request;

class clientController extends Controller
{
    //pagina inicial do cliente
   public function index()
    {
        $clients = Client::all();    
        //dd($clients);  
        return view('client.index', ['clients' => $clients]);
        
    }

    //pagina de novo cliente
    public function add()
    {
        
        return view('client.add');  
    }

    //pagina de detalhes do cliente
    public function show($id)
    {
        try {
            $client = Client::find($id);
            return view('client.show', $client);  
        } catch (\Exception $e) {
            return redirect()->route('client.index')->with('error', 'Cliente não encontrado.'); 
        }
    }

    //pagina de edicao do cliente
    public function edit($id)
    {
        try {
            $client = Client::find($id);
            return view('client.edit', compact('client'));  
        } catch (\Exception $e) {
            return redirect()->route('client.index')->with('error', 'Cliente não encontrado.');   
        }
    }

    //adicionar novo cliente
    public function store(Request $request)
    {
        //validar dados
        $this->validateClient($request);        
        try {
            Client::create($request->all());
            return redirect()->route('client.index')->with('success', 'Cliente criado com sucesso.');  
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->route('client.index')->with('error', 'Erro ao criar cliente.');   
        }
    }

    //atualizar cliente
    public function update(Request $request, $id)
    {
       
        //valicar dados
        $this->validateClient($request);
        
        try {
            $client = Client::find($id);
            $client->update($request->all());
            return redirect()->route('client.show', $id)->with('success', 'Cliente atualizado com sucesso.');  
        } catch (\Exception $e) {
            dD('chegou aqui');
            return redirect()->route('client.index')->with('error', 'Erro ao atualizar cliente.');   
        }
    }

    //Excluir cliente
    public function destroy($id)
    {
        try {
            // verifica se o cliente tem pedidos associados

            //posssibilidade de usar with e carregar todos os pedidos de uma vez
           // $client = Client::with('orders')->find($id);
            $client = Client::find($id);
            
            //buscando o pedido e acessando o id do cliente
           // $order = Order::with('client')->find('3');
          //  $orderclieentid = $order->client->id;
          
            // valida para ver se o cliente tem pedidos associados
           if ($client->orders()->count() > 0) {
                return redirect()->route('client.index')->with('error', 'Não é possível excluir o cliente porque ele possui pedidos associados.');
            } else
            {
                $client->delete();
                return redirect()->route('client.index')->with('success', 'Cliente excluído com sucesso.');  
            }
            
        } catch (\Exception $e) {
            dd($e)->getMessage();
            return redirect()->route('client.index')->with('error', 'Erro ao excluir cliente.');   
        }
    }

    //lista de clientes
    public function list()
    {
        $clients = Client::all();      
        return view('client.list', ['clients' => $clients]);
    }

    //validar dados do cliente
    protected function validateClient(Request $request)
    {
         //validação dos dados
        
        return $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:clientes,email,' . $request->route('id'),
            'telefone' => 'required|nullable|string|max:20',
            'endereco' => 'required|nullable|string|max:255',
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'email.required' => 'O campo email é obrigatório.',
            'endereco.required' => 'O campo endereço é obrigatório.',
            'telefone.required' => 'O campo telefone é obrigatório.',
            'email.email' => 'O campo email deve ser um endereço de email válido.',
            'email.unique' => 'O email informado já está em uso por outro cliente.',
        ]);
        
    }
}
