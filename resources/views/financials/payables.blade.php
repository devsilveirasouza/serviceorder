<!-- resources/views/financials/payables.blade.php -->

@extends('layouts.principal')

@section('content')
<div class="container">
    <h1 class="text-center">Contas a Pagar</h1>

    <!-- Form to Add New Payable -->
    <h3>Adicionar Nova Conta a Pagar</h3>
    <form action="{{ route('financial.payables.create') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="description">Fornecedor:</label>
            <input type="text" class="form-control mt-2" id="description" name="description" placeholder="Enter Fornecedor" required>
        </div>
        <div class="form-group">
            <label for="amount">Valor:</label>
            <input type="number" step="0.01" class="form-control mt-2" id="amount" name="amount" placeholder="Enter Valor" required>
        </div>
        <div class="form-group">
            <label for="due_date">Data Vencimento:</label>
            <input type="date" class="form-control mt-2" id="due_date" name="due_date" required>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control mt-2 mb-2" id="status" name="status">
                <option value="Pending">Pending</option>
                <option value="Paid">Paid</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-2 mb-2">Adicionar Pagamento</button>
    </form>

    <!-- Display Existing Payables -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fornecedor</th>
                <th>Valor</th>
                <th>Data de Cadastro</th>
                <th>Data de Vencimento</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payables as $payable)
            <tr>
                <td>{{ $payable->id }}</td>
                <td>{{ $payable->description }}</td>
                <td>{{ number_format($payable->amount, 2) }}</td>
                <td>{{ date_format($payable->created_at,'d/m/Y') }}</td>
                <!-- Converter string em date -->
                <td>{{ \Carbon\Carbon::parse($payable->due_date)->format('d/m/Y') }}</td>
                <td>{{ $payable->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection