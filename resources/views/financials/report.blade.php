<!-- resources/views/financials/report.blade.php -->

@extends('layouts.principal')

@section('content')
<div class="container">
    <h1 class="text-center">Relatório Financeiro</h1>

    <!-- Form to Filter Reports -->
    <form action="{{ route('financials.report') }}" method="GET">
        <div class="row">

            <div class="form-group col-md-6">
                <label for="start_date">Data Início:</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>
            <div class="form-group col-md-6">
                <label for="end_date">Data Fim:</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>

        </div>

        <button type="submit" class="btn btn-primary mt-2">Gerar Relatório</button>
    </form>

    <h2 class="mt-5 text-center">Contas à Pagar</h2>
    <table class="table">
        <thead class="text-center">
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Data de Vencimento</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payables as $payable)
            <tr>
                <td>{{ $payable->id }}</td>
                <td>{{ $payable->description }}</td>
                <td class="text-center">R$ {{ number_format($payable->amount, 2, ',', '.') }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($payable->due_date)->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2 class="mt-5 text-center">Contas à Receber</h2>
    <table class="table">
        <thead class="text-center">
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Data de Vencimento</th>
            </tr>
        </thead>
        <tbody>
            @foreach($receivables as $receivable)
            <tr>
                <td>{{ $receivable->id }}</td>
                <td>{{ $receivable->description }}</td>
                <td class="text-center">R$ {{ number_format($receivable->amount, 2, ',', '.') }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($receivable->due_date)->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection