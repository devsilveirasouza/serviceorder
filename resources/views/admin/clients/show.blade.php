@extends('layouts.principal')

@section('title', '<i class="ri-user-5-line"></i> Clients')

@section('content')

<div style="margin-left: 250px;" class="col-md-10">
    <div class="h-100 p-5 bg-light border rounded-3">
        <h2>{{ $client->name }}</h2>
        <label for="">Email: </label>
        <hr>
        <p>{{ $client->email }}</p>
        <p>{{ $client->phone }}</p>
        <p>{{ $client->address }}</p>
        <label for="">Data de Cadastro: </label>
        @if ($client->created_at)
        <p>{{ date_format($client->created_at, 'd/m/Y') }}</p>
        @else
        <p>Não disponível</p>
        @endif
        <hr>
        <a href="{{ route('clients.index') }}" class="btn btn-outline-primary" type="button">Voltar</a>
    </div>
</div>

@endsection