@extends('layouts.principal')

@section('title', '<i class="ri-user-5-line"></i> Vehicles')

@section('content')

<div class="col-md-12">
    <div class="h-100 p-5 bg-light border rounded-3">
        <h2>{{ $vehicle->client->name }}</h2>
        <hr>
        <label for="">Modelo: </label>
        <p>{{ $vehicle->model }}</p>
        <hr>
        <label for="">Marca: </label>
        <p>{{ $vehicle->brand }}</p>
        <hr>
        <label for="">Placa: </label>
        <p>{{ $vehicle->plate }}</p>
        <hr>
        <label for="">Data de Cadastro: </label>
        @if ($vehicle->created_at)
        <p>{{ date_format($vehicle->created_at, 'd/m/Y') }}</p>
        @else
        <p>Não disponível</p>
        @endif
        <hr>
        <a href="{{ route('vehicles.index') }}" class="btn btn-outline-primary" type="button">Voltar</a>
    </div>
</div>

@endsection