@extends('layouts.principal')

@section('title', 'Home')

@section('content')

<div class="content">

    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        {{ __('You are logged in!') }}
        {{ Auth::user()->name }}

        <div class="card-body">
            <div class="card-header">
                <h3>Bem-vindo!</h3>
            </div>
            <p>Esta é sua área administrativa, onde você pode gerenciar os principais recursos do sistema.</p>
            <p>Aqui você encontrará informações sobre usuários, clientes, veículos, peças, serviços e relatórios.</p>
            <p>Use o menu lateral para navegar entre as diferentes seções e explorar as funcionalidades disponíveis.</p>
        </div>
    </div>

</div>

@endsection