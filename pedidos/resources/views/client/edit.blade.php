<div>
    <form action="{{ route('client.update', $client->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="{{ old('nome', $client->nome) }}" required>
            @error('nome')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $client->email) }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div>
            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" value="{{ old('telefone', $client->telefone) }}" required>
            @error('telefone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div>
            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" value="{{ old('endereco', $client->endereco) }}" required>
            @error('endereco')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit">Atualizar Cliente</button>
</div>
