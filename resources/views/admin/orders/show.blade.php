@extends('layouts.principal')

@section('title', 'Orders')

@section('content')

<div style="margin-left: 250px;" class="col-md-10">
    <div class="h-100 p-5 bg-light border rounded-3">
        <h2>OS: # {{ $order->id }}</h2>        
        <hr>
        <label for="vehicle">Veículo:</label>
        <p>{{ $order->vehicle->model }}</p>
        <hr>
        <label for="plate">Placa:</label> 
        <p>{{ $order->vehicle->plate }}</p>
        <hr>
        <label for="status">Status:</label>
        <p>{{ $order->status }}</p>
        <hr>
        <label for="created_at">Data de Cadastro</label>
        @if ($order->created_at)
        <p>{{ date_format($order->created_at, 'd/m/Y') }}</p>
        @else
        <p>Não informado</p>
        @endif
        <hr>
        <a href="{{ route('orders.index') }}" class="btn btn-outline-primary" type="button">Voltar</a>
    </div>
</div>

@endsection