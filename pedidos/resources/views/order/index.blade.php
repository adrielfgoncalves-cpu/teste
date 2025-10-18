<div>
    <td> <a href="{{route('order.new')}}" >Novo Pedido</a> </td>
    <td> <a href="/" >Início</a> </td>
    <!-- lista de pedidos em uma tabel -->
    <table>
        <thead>
            <tr>
                <th>ID do Pedido</th>
                <th>Cliente</th>
                <th>Produtos</th>
                <th>Data do Pedido</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->client->nome }}</td>
                    <td>
                        <ul>
                            @foreach($order->products as $product)
                                <li>{{ $product->nome }} (Quantidade: {{ $product->pivot->quantidade }})</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $order->data_pedido->format('d/m/Y') }}</td>
                    <td>{{ $order->total }}</td>
                </tr>
            @endforeach
        </tbody>
</div>
