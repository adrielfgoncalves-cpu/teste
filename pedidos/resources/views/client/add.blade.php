<div>
    <!-- formulário para adicionar novo cliente -->
     <form action="{{ route('client.store') }}" method="POST">
        @csrf
        
        <div>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="{{ old('nome') }}" required>
            @error('nome')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div>
            <label for="telefone">CPF:</label>
            <input type="text" id="telefone" name="telefone" value="{{ old('telefone') }}" required>
            @error('telefone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div>
            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" value="{{ old('endereco') }}" required>
            @error('endereco')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit">Adicionar Cliente</button>
</div>
