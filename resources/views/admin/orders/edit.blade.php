@extends('layouts.principal')

@section('title', 'Edit Order')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="p-1">
            <div class="card col-md-6">

                <div class="card-header mt-4 text-center bg-dark text-white">Gestão de Ordem de Serviço</div>

                <div class="card-body">
                    <div class="container mt-5">
                        <h1 class="mb-4">Editar Ordem de Serviço</h1>
                        <h3>Nº Ordem de Serviço: # {{ $order->id }}</h3>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('orders.update', $order) }}" method="POST" >
                            @csrf
                            @method('PUT')
                            @include('admin.orders._form', ['order' => $order])
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection