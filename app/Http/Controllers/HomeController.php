<?php

namespace App\Http\Controllers;

use App\Models\Carteira;
use App\Models\Metas;
use App\Models\Proventos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $total = Carteira::select(
            DB::raw('SUM(CASE WHEN carteira.compra_venda = "compra" THEN carteira.valor ELSE - carteira.valor END) as total')
        )->first();

        $ultimas_transacoes = Carteira::orderBy('data_negociacao', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'transacoes');

        $fixa_variavel = Carteira::select(
            'carteira.categoria',
            DB::raw('SUM(CASE WHEN carteira.compra_venda = "compra" THEN carteira.valor ELSE - carteira.valor END) as total')
        )
            ->groupBy(['carteira.categoria'])
            ->get();

        $classe_ativos = Carteira::select(
            'carteira.produto',
            DB::raw('SUM(CASE WHEN carteira.compra_venda = "compra" THEN carteira.valor ELSE - carteira.valor END) as total')
        )
            ->groupBy(['carteira.produto'])
            ->having('total', '>', 0)
            ->get();

        $tesouro_direto = Carteira::select(
            'carteira.nome',
            'carteira.corretora',
            DB::raw('SUM(CASE WHEN carteira.compra_venda = "compra" THEN carteira.quantidade ELSE - carteira.quantidade END) as quantidade'),
            DB::raw('SUM(CASE WHEN carteira.compra_venda = "compra" THEN carteira.valor ELSE - carteira.valor END) as total')
        )
            ->where('carteira.produto', 'tesouro')
            ->groupBy(['carteira.categoria', 'carteira.produto', 'carteira.nome', 'carteira.corretora'])
            ->having('total', '>', 0)
            ->paginate(5, ['*'], 'tesouro');

        $fundos = Carteira::select(
            'carteira.nome',
            'carteira.corretora',
            DB::raw('SUM(CASE WHEN carteira.compra_venda = "compra" THEN carteira.quantidade ELSE - carteira.quantidade END) as quantidade'),
            DB::raw('SUM(CASE WHEN carteira.compra_venda = "compra" THEN carteira.valor ELSE - carteira.valor END) as total')
        )
            ->where('carteira.produto', 'fundo')
            ->groupBy(['carteira.categoria', 'carteira.produto', 'carteira.nome', 'carteira.corretora'])
            ->having('total', '>', 0)
            ->paginate(5, ['*'], 'fundos');

        $cdb = Carteira::select(
            'carteira.nome',
            'carteira.corretora',
            DB::raw('SUM(CASE WHEN carteira.compra_venda = "compra" THEN carteira.quantidade ELSE - carteira.quantidade END) as quantidade'),
            DB::raw('SUM(CASE WHEN carteira.compra_venda = "compra" THEN carteira.valor ELSE - carteira.valor END) as total')
        )
            ->where('carteira.produto', 'cdb')
            ->groupBy(['carteira.categoria', 'carteira.produto', 'carteira.nome', 'carteira.corretora'])
            ->having('total', '>', 0)
            ->paginate(5, ['*'], 'cdb');

        $fii = Carteira::select(
            'carteira.nome',
            'carteira.corretora',
            DB::raw('SUM(CASE WHEN carteira.compra_venda = "compra" THEN carteira.quantidade ELSE - carteira.quantidade END) as quantidade'),
            DB::raw('SUM(CASE WHEN carteira.compra_venda = "compra" THEN carteira.valor ELSE - carteira.valor END) as total')
        )
            ->where('carteira.produto', 'fii')
            ->groupBy(['carteira.categoria', 'carteira.produto', 'carteira.nome'])
            ->having('total', '>', 0)
            ->paginate(5, ['*'], 'fii');

        $acoes = Carteira::select(
            'carteira.nome',
            'carteira.corretora',
            DB::raw('SUM(CASE WHEN carteira.compra_venda = "compra" THEN carteira.quantidade ELSE - carteira.quantidade END) as quantidade'),
            DB::raw('SUM(CASE WHEN carteira.compra_venda = "compra" THEN carteira.valor ELSE - carteira.valor END) as total')
        )
            ->where('carteira.produto', 'acoes')
            ->groupBy(['carteira.categoria', 'carteira.produto', 'carteira.nome', 'carteira.corretora'])
            ->having('total', '>', 0)
            ->paginate(5, ['*'], 'acoes');

        $internacional = Carteira::select(
            'carteira.nome',
            'carteira.corretora',
            DB::raw('SUM(CASE WHEN carteira.compra_venda = "compra" THEN carteira.quantidade ELSE - carteira.quantidade END) as quantidade'),
            DB::raw('SUM(CASE WHEN carteira.compra_venda = "compra" THEN carteira.valor ELSE - carteira.valor END) as total')
        )
            ->where('carteira.produto', 'internacional')
            ->groupBy(['carteira.categoria', 'carteira.produto', 'carteira.nome', 'carteira.corretora'])
            ->having('total', '>', 0)
            ->paginate(5, ['*'], 'internacional');

        $proventos = Proventos::orderBy('data_negociacao', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(5, ['*'], 'proventos');

        $proventos_total = Proventos::select(
                DB::raw('SUM(proventos.valor) as total')
            )->first();

        $metas = Metas::select(
                'metas.descricao',
                'metas.valor',
                DB::raw('('.$total['total'].' / metas.valor * 100) as porcentagem')
            )
            ->orderBy('porcentagem', 'asc')
            ->paginate(5, ['*'], 'metas');

        $dados = [
            'total' => $total['total'],
            'ultimas_transacoes' => $ultimas_transacoes,
            'fixa_variavel' => $fixa_variavel,
            'classe_ativos' => $classe_ativos,
            'tesouro_direto' => $tesouro_direto,
            'fundos' => $fundos,
            'cdb' => $cdb,
            'fii' => $fii,
            'acoes' => $acoes,
            'internacional' => $internacional,
            'proventos' => $proventos,
            'proventos_total' => $proventos_total['total'],
            'metas' => $metas,
        ];

        return view('home.home')->with('dados', $dados);
    }
}
