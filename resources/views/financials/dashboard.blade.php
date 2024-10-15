@extends('layouts.principal')

@section('title', 'Dashboard')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">

                    <h1>Dashboard Financeiro</h1>
                    <p>Você está logado!</p>
                    <p>Bem Vindo, {{ Auth::user()->name }}!</p>
                    <p><a href="{{ route('logout') }}">Sair</a></p>

                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <!-- Filtro de Período Início -->
                    <form method="GET" action="{{ route('financial.dashboard') }}">
                        <div class="form-group row">
                            <label for="start_date" class="col-sm-2 col-form-label">Data Início:</label>
                            <div class="col-sm-4">
                                <input type="date" name="start_date" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                            </div>

                            <label for="end_date" class="col-sm-2 col-form-label">Data Fim:</label>
                            <div class="col-sm-4">
                                <input type="date" name="end_date" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Filtrar</button>
                    </form>

                    <table class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th>Contas a Pagar</th>
                                <th>Contas a Receber</th>
                                <th>Contas Pagas</th>
                                <th>Contas Recebidas</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td class="text-center">R$ {{ $accountsPayable }}</td>
                                <td class="text-center">R$ {{ $accountsReceivable }}</td>
                                <td class="text-center">R$ {{ $paydAccounts }}</td>
                                <td class="text-center">R$ {{ $receivedAccounts }}</td>
                            </tr>
                        </tbody>

                    </table>

                    <!-- Filtro de Período Fim -->
                    <h3 class="mt-2 mb-2 text-center">Gráfico Financeiro</h3>
                        <!-- Gráfico -->
                        <canvas id="financialChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script para exibir o Chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Script para exibir os Datalabels -->
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

<script>
    var ctx = document.getElementById('financialChart').getContext('2d');
    var financialChart = new Chart(ctx, {
        type: 'bar', // Tipo de gráfico
        data: {
            labels: ['Contas a Pagar', 'Contas a Receber', 'Contas Pagas', 'Contas Recebidas'],
            datasets: [{
                label: 'Valores em R$',
                data: [
                    {{ $accountsPayable }}, 
                    {{ $accountsReceivable }}, 
                    {{ $paydAccounts }}, 
                    {{ $receivedAccounts }}
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)', // Contas a Pagar
                    'rgba(54, 162, 235, 0.2)', // Contas a Receber
                    'rgba(75, 192, 192, 0.2)', // Contas Pagas
                    'rgba(153, 102, 255, 0.2)' // Contas Recebidas
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                datalabels: {
                    anchor: 'end',          // Posição da label
                    align: 'end',           // Alinhamento da label
                    color: 'black',         // Cor do texto
                    font: {
                        weight: 'bold',     // Texto em negrito
                        size: 12            // Tamanho da fonte
                    },
                    formatter: function(value, context) {
                        return 'R$ ' + value.toFixed(2); // Formatação do valor com 2 casas decimais
                    }
                }
            }
        },
        plugins: [ChartDataLabels] // Ativando o plugin Data Labels
    });
</script>

@endsection