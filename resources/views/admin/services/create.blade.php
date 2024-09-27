@extends('layouts.principal')

@section('title', 'Create Services')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="p-1">
            <div class="card col-md-6">

                <div class="card-header mt-4 text-center bg-dark text-white">Gestão de Serviços</div>

                <div class="card-body">
                    <div class="container mt-5">
                        <h1 class="mb-4">Cadastrar Serviços</h1>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('services.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="form-group">
                                    <label for="name">Descrição:</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <label for="price">Preço:</label>
                                    <input type="text" class="form-control" id="price" name="price" required>
                                </div>
                            </div>
                            
                            <div class="row">
                                <button type="submit" class="btn btn-success mt-3">Criar</button>
                                <button type="reset" class="btn btn-secondary mt-3">Limpar</button>
                                <a href="{{ route('services.index') }}" class="btn btn-primary mt-3" type="button">Voltar</a>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection