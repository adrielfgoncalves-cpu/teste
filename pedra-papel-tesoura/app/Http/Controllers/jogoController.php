<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class jogoController extends Controller
{
    
    public function index()
    {
        return view('jogo');
    }
    public function jogar(Request $request)
    {
        $opcaoUsuario = $request->input('opcao');
        $possibilidades = ['pedra', 'papel', 'tesoura'];
        $opcaoMaquina = $possibilidades[array_rand($possibilidades)];
       // dd($opcaoUsuario);

        if ($opcaoUsuario === null) {
            return redirect()->route('jogo')->with('error', 'Por favor, selecione uma opção.');
        }
        
        if ($opcaoUsuario === $opcaoMaquina) {
            $resultado = 'Empate!';
        } elseif (
            ($opcaoUsuario === 'pedra' && $opcaoMaquina === 'tesoura') ||
            ($opcaoUsuario === 'papel' && $opcaoMaquina === 'pedra') ||
            ($opcaoUsuario === 'tesoura' && $opcaoMaquina === 'papel')
        ) {
            $resultado = 'Você venceu!';
        } else {
            $resultado = 'Você perdeu!';
        }
       
        $resultadoJson = [
            'resultado' => $resultado,
            'opcaoMaquina' => $opcaoMaquina,
            'opcaoUsuario' => $opcaoUsuario
        ];
        //dd($resultadoJson);
        
        return view ('jogo', compact('resultadoJson'));

        
    }
}
