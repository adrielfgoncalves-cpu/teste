<div>
    <!-- formulário para adicionar produto -->
     <form action="{{ route('product.store') }}" method="POST">
        @csrf
        
        <div>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="{{ old('nome') }}" required>
            @error('nome')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div>
            <label for="descricao">Descrição:</label>
            <input type="text" id="descricao" name="descricao" value="{{ old('descricao') }}">
            @error('descricao')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div>
            <label for="preco">Preço:</label>
            <input type="number" step="0.01" id="preco" name="preco" value="{{ old('preco') }}" required>
            @error('preco')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div>
            <label for="estoque">Estoque:</label>
            <input type="number" id="estoque" name="estoque" value="{{ old('estoque') }}" required>
            @error('estoque')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit">Adicionar Produto</button>
</div>
