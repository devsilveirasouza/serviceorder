@extends('layouts.principal')

@section('title', '<i class="ri-user-5-line"></i> Orders')

@section('content')

<div class="col-md-12">
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
        <p>{{ date_format($order->created_at, 'd/m/Y') }}</p>
        <hr>
        <a href="{{ route('orders.index') }}" class="btn btn-outline-primary" type="button">Voltar</a>
    </div>
</div>

@endsection