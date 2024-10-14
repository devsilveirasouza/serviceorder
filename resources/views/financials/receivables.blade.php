<!-- resources/views/financials/payables.blade.php -->

@extends('layouts.principal')

@section('title', 'Contas a Receber')

@section('content')
<div class="container">
    <h1 class="text-center">Contas a Receber</h1>

    <!-- Form to Add New Payable -->
    <h3>Adicionar Nova Conta a Receber</h3>
    <form action="{{ route('financial.payables.create') }}" method="POST">
        @csrf
        <div class="row">

            <div class="form-group">
                <label for="description">Cliente:</label>

                <select class="form-control mt-2" name="client_id" id="client_id" required>
                    <option value="" selected>Selecione um cliente</option>
                    @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                    @endforeach
                </select>

                <!-- <input type="text" class="form-control mt-2" id="description" name="description" placeholder="Enter Fornecedor" required> -->
            </div>

        </div>

        <div class="row">

            <div class="form-group col-md-4">
                <label for="amount">Valor:</label>
                <input type="number" step="0.01" class="form-control mt-2" id="amount" name="amount" placeholder="Enter Valor" required>
            </div>
            <div class="form-group col-md-4">
                <label for="due_date">Data Vencimento:</label>
                <input type="date" class="form-control mt-2" id="due_date" name="due_date" required>
            </div>
            <div class="form-group col-md-4">
                <label for="status">Status:</label>
                <select class="form-control mt-2 mb-2" id="status" name="status">
                    <option value="Pending">Pending</option>
                    <option value="Paid">Paid</option>
                </select>
            </div>

        </div>

        <button type="submit" class="btn btn-primary mt-2 mb-2">Adicionar Pagamento</button>
    </form>

    <!-- Display Existing Receivables -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Valor</th>
                <th>Data de Cadastro</th>
                <th>Data de Vencimento</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($receivables as $receivable)
            <tr>
                <td>{{ $receivable->id }}</td>
                <td>{{ $receivable->description }}</td>
                <td>{{ number_format($receivable->amount, 2) }}</td>
                <td>{{ date_format($receivable->created_at,'d/m/Y') }}</td>
                <!-- Converter string em date -->
                <td>{{ \Carbon\Carbon::parse($receivable->due_date)->format('d/m/Y') }}</td>
                <td>{{ $receivable->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection