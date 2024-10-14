@extends('layouts.principal')

@section('title', 'Parcelamentos')

@section('content')

<div class="container">

    <h1>Adicionar Parcelamento</h1>

    <!-- Form to Add New Installment -->
    <form action="{{ route('payment.installments.create') }}" method="POST">
        @csrf
        <div class="row">

            <div class="form-group col-md-4 mt-2">
                <label for="account_id">Ordem de Serviço:</label>
                <select class="form-control mt-2" name="account_id" id="account_id">
                    <option value="" selected>Selecione uma Ordem de Serviço</option>
                    @foreach($orders as $order)
                    <option value="{{ $order->id }}">{{ $order->id }} - {{ $order->client->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4 mt-2">
                <label for="amount">Valor da Parcela:</label>
                <input type="number" step="0.01" class="form-control mt-2" id="amount" name="amount" placeholder="Digite o valor" required>
            </div>
            <div class="form-group col-md-4 mt-2">
                <label for="due_date">Data de Vencimento:</label>
                <input type="date" class="form-control mt-2" id="due_date" name="due_date" required>
            </div>

        </div>

        <button type="submit" class="btn btn-primary mt-3">Adicionar Parcelamento</button>
    </form>
</div>

@endsection