@extends('layouts.principal')

@section('title', 'Ordem de Serviço')

@section('content')

<div class="container mt-5">
    <div class="row">

        <!-- Informações da Ordem de Serviço -->
        <div class="justify-content-start col-md-12">
            <h2 class="mb-4 text-center">Ordem de Serviço: {{ $order->id }}</h2>
        </div>

    </div>

    <hr>

    <!-- Informações do Cliente e Veículo -->
    <div class="row mb-4">
        <div class="col-md-4">
            <h5>Dados do Cliente</h5>
            <ul class="list-group">
                <li class="list-group-item"><strong>Nome: </strong>{{ $order->client->name }}</li>
                <li class="list-group-item"><strong>Email: </strong>{{ $order->client->email }}</li>
                <li class="list-group-item"><strong>Telefone: </strong>{{ $order->client->phone }}</li>
            </ul>
        </div>


        <!-- Dados do Veículo -->
        <div class="col-md-4">
            <h5>Dados do Veículo</h5>
            <ul class="list-group">
                <li class="list-group-item"><strong>Placa: </strong>{{ $order->vehicle->plate }}</li>
                <li class="list-group-item"><strong>Marca: </strong>{{ $order->vehicle->brand }}</li>
                <li class="list-group-item"><strong>Modelo: </strong>{{ $order->vehicle->model }}</li>
            </ul>
        </div>

        <!-- Status -->
        <div class="col-md-4">
            <h5>Informações Gerais</h5>
            <ul class="list-group">
                <li class="list-group-item"><strong>Usuário: </strong>{{ $order->user->name }}</li>
                <li class="list-group-item"><strong>Data: </strong>{{ $order->created_at->format('d/m/Y') }}</li>
                <li class="list-group-item"><strong>Status: </strong>{{ $order->status }}</li>
            </ul>
        </div>
    </div>

    <hr>
    <!-- Peças Utilizadas -->
    <h5 class="mt-4 text-center"><strong>Peças Utilizadas</strong></h5>
    @if($order->parts->isEmpty())
    <p>Nenhuma peça adicionada a esta ordem.</p>
    @else
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th class="col-md-7">Descrição</th>
                <th class="text-center col-md-1">Quantidade</th>
                <th class="text-center col-md-2">Preço Unitário</th>
                <th class="text-center col-md-2">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->parts as $part)
            <tr>
                <td>{{ $part->part->name }}</td>
                <td class="text-center">{{ $part->quantity }}</td>
                <td class="text-center">R$ {{ number_format($part->unit_price, 2, ',', '.') }}</td>
                <td class="text-center">R$ {{ number_format($part->total_price, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    <!-- Serviços Realizados -->
    <h5 class="mt-4 text-center"><strong>Serviços Realizados</strong></h5>
    @if($order->services->isEmpty())
    <p>Nenhum serviços adicionado a esta ordem.</p>
    @else
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th class="col-md-7">Descrição</th>
                <th class="text-center col-md-1">Quantidade</th>
                <th class="text-center col-md-2">Preço Unitário</th>
                <th class="text-center col-md-2">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->services as $service)
            <tr>
                <td>{{ $service->service->name }}</td>
                <td class="">{{ $service->quantity }}</td>
                <td class="text-center">{{ number_format($service->unit_price, 2, ',', '.') }}</td>
                <td class="text-center">{{ number_format($service->total_price, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <hr>

    <div class="row justify-content-end">
        <div class="col-md-2 mr-2">
            <ul class="list-group text-center">
                <li class="list-group-item"><strong>Valor Total</strong></li>
                <li class="list-group-item">R$ {{ number_format($order->total_price, 2, ',', '.') }}</li>
            </ul>
        </div>
    </div>

</div>
@endsection