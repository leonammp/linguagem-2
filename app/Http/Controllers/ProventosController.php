<?php

namespace App\Http\Controllers;

use App\Models\Proventos;
use Illuminate\Http\Request;

class ProventosController extends Controller
{
    public function add(Request $request)
    {
        $provento = new Proventos();

        $provento->tipo = $request->tipo;
        $provento->nome = strtoupper($request->nome);
        $provento->data_negociacao = $request->data_negociacao;
        $provento->valor = str_replace(',', '', $request->valor);

        if ($provento->save()){
            return redirect()
                ->route('home.index')
                ->with('success', 'Provento registrado com sucesso!');
        }

        return redirect()
            ->route('home.index')
            ->with('error', 'Ocorreu um erro, tente novamente!');
    }
}
