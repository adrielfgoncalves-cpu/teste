<div>
    <td> <a href="{{route('product.new')}}" >Novo Produto</a> </td>
    <td> <a href="/" >Início</a> </td>
    <!-- lista de produtos em uma table -->
     <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->nome }}</td>
                    <td>{{ $product->descricao }}</td>
                    <td>{{ $product->preco }}</td>
                    <td>{{ $product->estoque }}</td>
                    <td> 
                        <a href="{{route('product.edit', $product->id)}}" >Editar</a>
                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Tem certeza que deseja excluir este produto?')">Excluir</button>
                            </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
      <x-alert/>
</div>
