<div>
     <td> <a href="{{route('client.new')}}" >Novo Cliente</a> </td>
     <td> <a href="/" >Início</a> </td>
    <!-- lista de clientes em uma table -->
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Endereço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->nome }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->telefone }}</td>
                    <td>{{ $client->endereco }}</td>
                    <td> <a href="{{route('client.edit', $client->id)}}" >Editar</a>
                        <form action="{{ route('client.destroy', $client->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Tem certeza que deseja excluir este cliente?')">Excluir</button>
                            </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
      <x-alert/>
</div>
