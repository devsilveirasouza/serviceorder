@extends('layouts.sidebar')

@section('title', 'Home')

@section('content')
    <h1>Bem-vindo, {{ Auth::user()->name }}!</h1>
    <p>Esta é sua área administrativa, onde você pode gerenciar os principais recursos do sistema.</p>
    <p>Aqui você encontrará informações sobre usuários, clientes, veículos, peças, serviços e relatórios.</p>
    <p>Use o menu lateral para navegar entre as diferentes seções e explorar as funcionalidades disponíveis.</p>
@endsection
