<div>
    <!-- formulário para editar produto -->
     <form action="{{ route('product.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="{{ old('nome', $product->nome) }}" required>
            @error('nome')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div>
            <label for="descricao">Descrição:</label>
            <input type="text" id="descricao" name="descricao" value="{{ old('descricao', $product->descricao) }}">
            @error('descricao')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div>
            <label for="preco">Preço:</label>
            <input type="number" step="0.01" id="preco" name="preco" value="{{ old('preco', $product->preco) }}" required>
            @error('preco')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div>
            <label for="estoque">Estoque:</label>
            <input type="number" id="estoque" name="estoque" value="{{ old('estoque', $product->estoque) }}" required>
            @error('estoque')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit">Atualizar Produto</button>
</div>
