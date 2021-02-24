<?php

namespace App\Http\Controllers;

use App\Models\Metas;
use Illuminate\Http\Request;

class MetasController extends Controller
{
    public function add(Request $request)
    {
        $meta = new Metas();

        $meta->descricao = $request->descricao;
        $meta->valor = str_replace(',', '', $request->valor);

        if ($meta->save()){
            return redirect()
                ->route('home.index')
                ->with('success', 'Meta registrada com sucesso!');
        }

        return redirect()
            ->route('home.index')
            ->with('error', 'Ocorreu um erro, tente novamente!');
    }

    public function destroy(Request $request)
    {
        $meta = Metas::where('descricao', $request->id)->first();

        if ($meta->delete()){
            return redirect()
                ->route('home.index')
                ->with('success', 'Meta removida com sucesso!');
        }

        return redirect()
            ->route('home.index')
            ->with('error', 'Ocorreu um erro, tente novamente!');
    }
}
