@extends('layouts.principal')

@section('title', 'Payment Methods')

@section('content')

<div class="container col-md-10">
    <div class="card-header">
        <h1 class="text-center m-4">Métodos de Pagamento</h1>
    </div>

    <!-- Add New Payment Method Form -->
    <h3 class="mt-3">Adicionar Novo Método de Pagamento</h3>
    <form action="{{ route('payment.methods.create') }}" method="POST">
        @csrf
        <div class="row">
            <div class="form-group">
                <label class="mt-3" for="method">Descrição<label>
                        <input type="text" name="method" id="method" class="form-control ms-2" placeholder="Método de pagamento" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Salvar</button>
    </form>
    <hr>
    <!-- Display Existing Payament Methods -->
    <table class="table table-striped">
        <thead>
            <tr class="table-primary">
                <td>ID</td>
                <th>Métodos de Pagamento</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($methods as $method)
            <tr>
                <td>{{ $method->id }}</td>
                <td>{{ $method->method }}</td>
                <td>
                    <!-- Action buttons for editing or deleting (if needed) -->
                    <button class="btn btn-warning btn-sm">Edit</button>
                    <button class="btn btn-danger btn-sm">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection