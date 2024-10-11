@extends('layouts.principal')

@section('title', '<i class="ri-user-5-line"></i> Users')

@section('content')

<div style="margin-left: 250px;" class="col-md-10">
    <div class="h-100 p-5 bg-light border rounded-3">
        <h2>{{ $user->name }}</h2>
        <hr>
        <label for="">Email: </label>
        <p>{{ $user->email }}</p>
        <hr>
        <label for="">Data de Cadastro: </label>
        @if ($user->created_at)
        <p>{{ date_format($user->created_at, 'd/m/Y') }}</p>
        @else
        <p>Não disponível</p>
        @endif
        <hr>
        <label for="">Tipo de Usuário: </label>
        <p>{{ $user->role }}</p>
        <hr>
        <a href="{{ route('users.index') }}" class="btn btn-outline-primary" type="button">Voltar</a>
    </div>
</div>

@endsection