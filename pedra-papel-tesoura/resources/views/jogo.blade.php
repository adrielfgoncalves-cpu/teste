<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedra Papel Tesoura</title>
</head>
<body>
    <div style="text-align: center;">
        <h1>Jogo pedra, papel, tesoura</h1>
        <form action="{{ route('jogar') }}" method="POST">
            @csrf
            <label for="escolha">Escolha sua jogada:</label>
            <select name="opcao" id="opcao" required>
                <option value="pedra">Pedra</option>
                <option value="papel">Papel</option>
                <option value="tesoura">Tesoura</option>
                <option value="">Nenhuma</option>
            </select>
            <button type="submit">Jogar</button>
        </form>
    </div>
    @if (session('error'))
        <div style="color: red; text-align: center; margin-top: 20px;">
            {{ session('error') }}
        </div>
    @endif
    @if (!empty($resultadoJson))
        <div style="text-align: center; margin-top: 20px;">
            <h2>Resultado:</h2>
            <p>{{ $resultadoJson['resultado'] }}</p>
        </div>
         <div style="text-align: center; margin-top: 10px;">
            <h3>Jogada do Computador:</h3>
            <p>{{ $resultadoJson['opcaoMaquina'] }}</p>
        </div>
        <div style="text-align: center; margin-top: 10px;">
            <h3>Sua Jogada:</h3>
            <p>{{ $resultadoJson['opcaoUsuario'] }}</p>
        </div>  
    @endif  
   
</body>
</html>