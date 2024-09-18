@extends('layouts.principal')

@section('title', 'Edit Client')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="p-1">
            <div class="card">
                <div class="card-header mt-4 text-center bg-dark text-white">Gestão de Clientes</div>
                <div class="card-body">
                    <div class="container mt-5">
                        <h1 class="mb-4">Atualizar Cliente</h1>

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('clients.update', $client) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" value="{{ $client->name }}" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" value="{{ $client->email }}" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone:</label>
                                <input type="text" value="{{ $client->phone }}" class="form-control" id="phone" name="phone" required>
                            </div>

                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input type="text" value="{{ $client->address }}" class="form-control" id="address" name="address" required>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3" onclick="return confirm('Você têm certeza que quer atualizar este registro?')">Atualizar</button>
                            <a href="{{ route('clients.index') }}" class="btn btn-secondary mt-3">Voltar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection