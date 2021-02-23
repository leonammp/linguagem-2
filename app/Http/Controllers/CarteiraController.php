<?php

namespace App\Http\Controllers;

use App\Models\Carteira;
use Illuminate\Http\Request;

class CarteiraController extends Controller
{
    public function store(Request $request)
    {
        $carteira = new Carteira();

        $carteira->categoria = $request->categoria;
        $carteira->produto = $request->produto;
        $carteira->nome = strtoupper($request->nome);
        $carteira->corretora = $request->corretora;
        $carteira->data_negociacao = $request->data_negociacao;
        $carteira->quantidade = $request->quantidade;
        $carteira->valor = $request->valor;
        $carteira->compra_venda = 'compra';

        if ($carteira->save()){
            return redirect()
                ->route('home.index')
                ->with('success', 'Compra registrada com sucesso!');
        }

        return redirect()
            ->route('home.index')
            ->with('error', 'Ocorreu um erro, tente novamente!');
    }

    public function buy(Request $request)
    {
        $carteira = new Carteira();

        $carteira->categoria = $request->categoria;
        $carteira->produto = $request->produto;
        $carteira->nome = strtoupper($request->nome);
        $carteira->corretora = $request->corretora;
        $carteira->data_negociacao = $request->data_negociacao;
        $carteira->quantidade = $request->quantidade;
        $carteira->valor = $request->valor;
        $carteira->compra_venda = 'venda';

        if ($carteira->save()){
            return redirect()
                ->route('home.index')
                ->with('success', 'Resgate registrado com sucesso!');
        }

        return redirect()
            ->route('home.index')
            ->with('error', 'Ocorreu um erro, tente novamente!');
    }
}
