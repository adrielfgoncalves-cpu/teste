@vite(['resources/js/order/addOrder.js'])
<div>
    <!-- formulário para adicionar novo pedido -->
     <form action="{{ route('order.store') }}" method="POST">
        @csrf
        
        <div>
            <label for="client_id">Cliente:</label>
            <select id="client_id" name="client_id" required>
                <option value="">Selecione um cliente</option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                        {{ $client->nome }} - {{ $client->email }}
                    </option>
                @endforeach
            </select>
            @error('client_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <br/>
        <div>
            <label for="products">Produto:</label>
            <select id="product_id" name="product_id" required>
                <option value="">Selecione um produto</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" data-price="{{ $product->preco }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->nome }} - R$ {{ number_format($product->preco, 2, ',', '.') }}
                    </option>
                @endforeach
            </select>
            <input type="hidden" name="preco_unitario" id="preco_unitario" value="">
            @error('products')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <br/>
        <div>
            
            <label for="quantidade">Quantidade:</label>
            <input type="text" id="quantidade" name="quantidade" value="{{ old('quantidade') }}" required>
            @error('quantidade')
                <div class="text-danger">{{ $message }}</div>
            @enderror
      
        </div>
        <br/>
        <div>
            <label for="total">Total:</label>
            <input type="text" id="total" name="total" value="{{ old('total') }}" required readonly>
            @error('total')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
                <br/>
        <button type="submit">Adicionar Pedido</button>
</div>

