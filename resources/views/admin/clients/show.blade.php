@extends('layouts.principal')

@section('title', '<i class="ri-user-5-line"></i> Clients')

@section('content')

<div class="col-md-12">
    <div class="h-100 p-5 bg-light border rounded-3">
        <h2>{{ $client->name }}</h2>
        <label for="">Email: </label>
        <hr>
        <p>{{ $client->email }}</p>
        <p>{{ $client->phone }}</p>
        <p>{{ $client->address }}</p>
        <label for="">Data de Cadastro: </label>
        <p>{{ date_format($client->created_at, 'd/m/Y') }}</p>
        <hr>
        <a href="{{ route('clients.index') }}" class="btn btn-outline-primary" type="button">Voltar</a>
    </div>
</div>

@endsection