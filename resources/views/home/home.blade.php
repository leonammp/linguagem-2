@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12" style="text-align: center">
            <div class="mt-4">
                <h2>Resumo da carteira</h2>
            </div>
            <br/>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p id="msg">{{ $message }}</p>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h5 class="text-center">Alocação da carteira</h5>
                <canvas id="alocacao_carteira" width="500px" height="250px"></canvas>
            </div>
            <div class="col-lg-6">
                <h5 class="text-center">Classe de ativos</h5>
                <canvas id="classe_ativos" width="500px" height="250px"></canvas>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <h5 class="text-center">Tesouro Direto</h5>
                <div class="table-responsive">
                    <table class="table table-bordered" id="user-table">
                        <tr>
                            <th>Ativo</th>
                            <th>Quantidade</th>
                            <th>Total</th>
                        </tr>
                        @foreach ($dados['tesouro_direto'] as $ativo)
                            <tr>
                                <td>{{ $ativo->nome }}</td>
                                <td>{{ $ativo->quantidade }}</td>
                                <td>R$ {{ number_format($ativo->total,2,",",".") }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="col-lg-4">
                <h5 class="text-center">Fundo de Investimento</h5>
                <div class="table-responsive">
                    <table class="table table-bordered" id="user-table">
                        <tr>
                            <th>Ativo</th>
                            <th>Quantidade</th>
                            <th>Total</th>
                        </tr>
                        @foreach ($dados['fundos'] as $ativo)
                            <tr>
                                <td>{{ $ativo->nome }}</td>
                                <td>{{ $ativo->quantidade }}</td>
                                <td>R$ {{ number_format($ativo->total,2,",",".") }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="col-lg-4">
                <h5 class="text-center">CDB/LCI/LCA/LC/LF</h5>
                <div class="table-responsive">
                    <table class="table table-bordered" id="user-table">
                        <tr>
                            <th>Ativo</th>
                            <th>Quantidade</th>
                            <th>Total</th>
                        </tr>
                        @foreach ($dados['cdb'] as $ativo)
                            <tr>
                                <td>{{ $ativo->nome }}</td>
                                <td>{{ $ativo->quantidade }}</td>
                                <td>R$ {{ number_format($ativo->total,2,",",".") }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="col-lg-4">
                <h5 class="text-center">Fundo Imobiliário</h5>
                <div class="table-responsive">
                    <table class="table table-bordered" id="user-table">
                        <tr>
                            <th>Ativo</th>
                            <th>Quantidade</th>
                            <th>Total</th>
                        </tr>
                        @foreach ($dados['fii'] as $ativo)
                            <tr>
                                <td>{{ $ativo->nome }}</td>
                                <td>{{ $ativo->quantidade }}</td>
                                <td>R$ {{ number_format($ativo->total,2,",",".") }}</td>
                            </tr>
                        @endforeach
                    </table>
                    {{ $dados['fii']->links() }}
                </div>
            </div>
            <div class="col-lg-4">
                <h5 class="text-center">Ações</h5>
                <div class="table-responsive">
                    <table class="table table-bordered" id="user-table">
                        <tr>
                            <th>Ativo</th>
                            <th>Quantidade</th>
                            <th>Total</th>
                        </tr>
                        @foreach ($dados['acoes'] as $ativo)
                            <tr>
                                <td>{{ $ativo->nome }}</td>
                                <td>{{ $ativo->quantidade }}</td>
                                <td>R$ {{ number_format($ativo->total,2,",",".") }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="col-lg-4">
                <h5 class="text-center">Internacional</h5>
                <div class="table-responsive">
                    <table class="table table-bordered" id="user-table">
                        <tr>
                            <th>Ativo</th>
                            <th>Quantidade</th>
                            <th>Total</th>
                        </tr>
                        @foreach ($dados['internacional'] as $ativo)
                            <tr>
                                <td>{{ $ativo->nome }}</td>
                                <td>{{ $ativo->quantidade }}</td>
                                <td>R$ {{ number_format($ativo->total,2,",",".") }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <h5>Últimas transações</h5>
            <div class="table-responsive">
                <table class="table table-bordered" id="transacoes">
                    <tr>
                        <th>Ativo</th>
                        <th>Qtd</th>
                        <th>Total</th>
                        <th>Data Negociação</th>
                        <th>Compra/Venda</th>
                    </tr>
                    @foreach ($dados['ultimas_transacoes'] as $ativo)
                        @if($ativo->compra_venda == 'venda')
                            <tr style="background-color: #fdbbb1">
                        @else
                            <tr style="background-color: #cefdb1">
                        @endif
                            <td>{{ $ativo->nome }}</td>
                            <td>{{ $ativo->quantidade }}</td>
                            <td>R$ {{ number_format($ativo->valor,2,",",".") }}</td>
                            <td>{{ date('d/m/Y', strtotime($ativo->data_negociacao)) }}</td>
                            <td>{{ $ativo->compra_venda }}</td>
                        </tr>
                    @endforeach
                </table>
                {{ $dados['ultimas_transacoes']->links() }}
            </div>
        </div>
        <div class="col-md-4">
            <h5>Proventos</h5>
            <div class="table-responsive">
                <table class="table table-bordered" id="proventos">
                    <tr>
                        <th>Ativo</th>
                        <th>Por cota</th>
                        <th>Total</th>
                        <th>Data</th>
                        <th>Dividendos/JCP</th>
                    </tr>
                    @foreach ($dados['ultimas_transacoes'] as $ativo)
                        @if($ativo->compra_venda == 'venda')
                            <tr style="background-color: #fdbbb1">
                        @else
                            <tr style="background-color: #cefdb1">
                                @endif
                                <td>{{ $ativo->nome }}</td>
                                <td>{{ $ativo->quantidade }}</td>
                                <td>R$ {{ number_format($ativo->valor,2,",",".") }}</td>
                                <td>{{ date('d/m/Y', strtotime($ativo->data_negociacao)) }}</td>
                                <td>{{ $ativo->compra_venda }}</td>
                            </tr>
                            @endforeach
                </table>
            </div>
        </div>
        <div class="col-md-4">
            <h5>Metas</h5>
            <div class="card proj-progress-card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-12">
                            <h6>Completed Work</h6>
                            <h5 class="m-b-30 f-w-700">532<span class="text-c-green m-l-10">+1.69%</span></h5>
                            <div class="progress">
                                <div class="progress-bar bg-c-red" style="width:25%"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h6>Incomplete Work</h6>
                            <h5 class="m-b-30 f-w-700">4,569<span class="text-c-red m-l-10">-0.5%</span></h5>
                            <div class="progress">
                                <div class="progress-bar bg-c-blue" style="width:65%"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h6>Ongoing Work</h6>
                            <h5 class="m-b-30 f-w-700">89%<span class="text-c-green m-l-10">+0.99%</span></h5>
                            <div class="progress">
                                <div class="progress-bar bg-c-green" style="width:85%"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h6>Ongoing Digs</h6>
                            <h5 class="m-b-30 f-w-700">365<span class="text-c-green m-l-10">+0.35%</span></h5>
                            <div class="progress">
                                <div class="progress-bar bg-c-yellow" style="width:45%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add ativo -->
    <div class="modal fade" id="add-ativo-modal" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAtivoModal">
                        Registrar compra
                    </h5>
                </div>
                <div class="modal-body">
                    <form name="custForm" action="{{ route('carteira.store') }}" method="POST" autocomplete="off">
                        <input type="hidden" name="ativo_id" id="ativo_id" >
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mx-auto">
                                <div class="form-group">
                                    <strong>Tipo de ativo <span class="required-filed">*</span></strong>
                                    <select type="text" name="categoria" id="categoria" class="form-control" required>
                                        <option value="fixa">Renda Fixa</option>
                                        <option value="variavel">Renda Variável</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <strong>Em qual produto você investiu? <span class="required-filed">*</span></strong>
                                    <select type="text" name="produto" id="produto" class="form-control" required>
                                        <option value="tesouro">Tesouro Direto</option>
                                        <option value="fundo">Fundo de Investimento</option>
                                        <option value="cdb">CDB/LCI/LCA/LC/LF</option>
                                        <option value="fii">FII</option>
                                        <option value="acoes">Ações</option>
                                        <option value="internacional">BDR (internacional)</option>
                                    </select>
                                </div>

                                <div class="tesouro">
                                    <div class="form-group">
                                        <strong>Qual o nome do ativo que comprou? <span class="required-filed">*</span></strong>
                                        <input type="text" name="nome" id="nome" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <strong>Em qual corretora? <span class="required-filed">*</span></strong>
                                        <select type="text" name="corretora" id="corretora" class="form-control" required>
                                            <option value="rico">Rico</option>
                                            <option value="clear">Clear</option>
                                            <option value="rci">RCI</option>
                                            <option value="xp">XP Investimentos</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <strong>Data de negociação <span class="required-filed">*</span></strong>
                                        <input type="date" name="data_negociacao" class="form-control" required>
                                    </div>
                                    <div class="form-group quantidade">
                                        <strong>Quantidade <span class="required-filed">*</span></strong>
                                        <input type="text" name="quantidade" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <strong>Valor investido <span class="required-filed">*</span></strong>
                                        <input type="text" name="valor" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" id="btn-save" name="btnsave" class="btn btn-success">Salvar transação</button>
                                <a href="{{ route('home.index') }}" class="btn btn-danger">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- BUY ativo -->
    <div class="modal fade" id="buy-ativo-modal" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="buyAtivoModal">
                        Registrar venda
                    </h5>
                </div>
                <div class="modal-body">
                    <form name="custForm" action="{{ route('carteira.buy') }}" method="POST" autocomplete="off">
                        <input type="hidden" name="ativo_id" id="ativo_id" >
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mx-auto">
                                <div class="form-group">
                                    <strong>Tipo de ativo <span class="required-filed">*</span></strong>
                                    <select type="text" name="categoria" id="categoria" class="form-control" required>
                                        <option value="fixa">Renda Fixa</option>
                                        <option value="variavel">Renda Variável</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <strong>Em qual produto você investiu? <span class="required-filed">*</span></strong>
                                    <select type="text" name="produto" id="produto" class="form-control" required>
                                        <option value="tesouro">Tesouro Direto</option>
                                        <option value="fundo">Fundo de Investimento</option>
                                        <option value="cdb">CDB/LCI/LCA/LC/LF</option>
                                        <option value="fii">FII</option>
                                        <option value="acoes">Ações</option>
                                        <option value="internacial">BDR (internacional)</option>
                                    </select>
                                </div>

                                <div class="tesouro">
                                    <div class="form-group">
                                        <strong>Qual o nome do ativo que comprou? <span class="required-filed">*</span></strong>
                                        <input type="text" name="nome" id="nome" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <strong>Em qual corretora? <span class="required-filed">*</span></strong>
                                        <select type="text" name="corretora" id="corretora" class="form-control" required>
                                            <option value="rico">Rico</option>
                                            <option value="clear">Clear</option>
                                            <option value="rci">RCI</option>
                                            <option value="xp">XP Investimentos</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <strong>Data de negociação <span class="required-filed">*</span></strong>
                                        <input type="date" name="data_negociacao" class="form-control" required>
                                    </div>
                                    <div class="form-group quantidade">
                                        <strong>Quantidade <span class="required-filed">*</span></strong>
                                        <input type="text" name="quantidade" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <strong>Valor resgatado <span class="required-filed">*</span></strong>
                                        <input type="text" name="valor" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" id="btn-save" name="btnsave" class="btn btn-primary">Salvar transação</button>
                                <a href="{{ route('home.index') }}" class="btn btn-danger">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>

        let options = {
            legend: {
                display: false
            },
            responsive: true,
                scales: {
                yAxes: [{
                    display: true,
                    ticks: {
                        beginAtZero: true,
                    }
                }]
            },
            hover: {
                mode: 'nearest',
                    intersect: true
            },
        };

        let backgroundColor = [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
        ];

        let borderColor = [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
        ];

        let chart_alocacao = $('#alocacao_carteira')
        let alocacao_carteira = new Chart(chart_alocacao, {
            type: 'bar',
            data: {
                labels: [
                    @foreach($dados['fixa_variavel'] as $alocacao)
                    '{{ $alocacao->categoria }}',
                    @endforeach
                ],
                datasets: [{
                    data : [
                        @foreach($dados['fixa_variavel'] as $alocacao)
                            {{ $alocacao->total }},
                        @endforeach
                    ],
                    backgroundColor,
                    borderColor,
                    borderWidth: 1
                }],
            },
            options
        });


        let chart_classe_ativos = $('#classe_ativos')
        let classe_ativos = new Chart(chart_classe_ativos, {
            type: 'bar',
            data: {
                labels: [
                    @foreach($dados['classe_ativos'] as $alocacao)
                        '{{ $alocacao->produto }}',
                    @endforeach
                ],
                datasets: [{
                    data : [
                        @foreach($dados['classe_ativos'] as $alocacao)
                        {{ $alocacao->total }},
                        @endforeach
                    ],
                    backgroundColor,
                    borderColor,
                    borderWidth: 1
                }],
            },
            options
        });
    </script>
    <style>
        td {
            font-size: 0.8rem;
            padding: 0.5rem !important;
        }
    </style>
@endsection
