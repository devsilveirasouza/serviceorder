@extends('layouts.principal')

@section('title', 'Create Client')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="p-1">
            <div class="card col-md-6">

                <div class="card-header mt-4 text-center bg-dark text-white">Gestão de Clientes</div>

                <div class="card-body">
                    <div class="container mt-5">
                        <h1 class="mb-4">Cadastrar Clientes</h1>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('clients.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="form-group">
                                    <label for="name">Nome:</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <label for="phone">Phone:</label>
                                    <input type="text" class="form-control" id="phone" name="phone" required>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group">
                                    <label for="address">Address:</label>
                                    <input type="text" class="form-control" id="address" name="address" required>
                                </div>
                            </div>

                            <div class="row">
                                <button type="submit" class="btn btn-success mt-3">Criar</button>
                                <button type="reset" class="btn btn-secondary mt-3">Limpar</button>
                                <a href="{{ route('clients.index') }}" class="btn btn-primary mt-3" type="button">Voltar</a>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection