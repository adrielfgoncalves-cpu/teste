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
        $opcoes = ['pedra', 'papel', 'tesoura'];
        $opcaoComputador = $opcoes[array_rand($opcoes)];
       // dd($opcaoUsuario);
        if ($opcaoUsuario === $opcaoComputador) {
            $resultado = 'Empate!';
        } elseif (
            ($opcaoUsuario === 'pedra' && $opcaoComputador === 'tesoura') ||
            ($opcaoUsuario === 'papel' && $opcaoComputador === 'pedra') ||
            ($opcaoUsuario === 'tesoura' && $opcaoComputador === 'papel')
        ) {
            $resultado = 'Você venceu!';
        } else {
            $resultado = 'Você perdeu!';
        }
       
        $resultadoJson = [
            'resultado' => $resultado,
            'opcaoComputador' => $opcaoComputador,
            'opcaoUsuario' => $opcaoUsuario
        ];
        //dd($resultadoJson);
        
        return view ('jogo', compact('resultadoJson'));

        
    }
}
