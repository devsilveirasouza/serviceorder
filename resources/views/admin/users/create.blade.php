@extends('layouts.principal')

@section('title', 'Create User')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="p-1">
            <div class="card col-md-6">

                <div class="card-header mt-4 text-center bg-dark text-white">Gestão de Usuários</div>

                <div class="card-body">
                    <div class="container mt-5">
                        <h1 class="mb-4">Cadastrar Usuários</h1>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('users.store') }}" method="POST">
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
                                    <label for="email">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                            </div>

                            <div class="form-group col-md-4 mt-3">
                                <label for="userType">Tipo de Usuário</label>
                                <select name="role" required>
                                    <option value="Admin">Administrador</option>
                                    <option value="Tecnico">Técnico</option>
                                    <option value="Usuario" selected>Usuário</option>
                                </select>
                            </div>

                            <div class="row">
                                <button type="submit" class="btn btn-success mt-3">Criar</button>
                                <button type="reset" class="btn btn-secondary mt-3">Limpar</button>
                                <a href="{{ route('users.index') }}" class="btn btn-primary mt-3" type="button">Voltar</a>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection