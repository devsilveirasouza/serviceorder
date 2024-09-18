@extends('layouts.principal')

@section('title', '<i class="ri-user-5-line"></i> Users')

@section('content')

<div class="col-md-12">
    <div class="h-100 p-5 bg-light border rounded-3">
        <h2>{{ $user->name }}</h2>
        <label for="">Email: </label>
        <hr>
        <p>{{ $user->email }}</p>
        <label for="">Data de Cadastro: </label>
        <p>{{ date_format($user->created_at, 'd/m/Y') }}</p>
        <hr>
        <label for="">Tipo de Usuário: </label>
        <p>{{ $user->role }}</p>
        <hr>
        <a href="{{ route('users.index') }}" class="btn btn-outline-primary" type="button">Voltar</a>
    </div>
</div>

@endsection