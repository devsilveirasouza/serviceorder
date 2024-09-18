@extends('layouts.principal')

@section('title', 'Edit Users')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="p-1">
            <div class="card">
                <div class="card-header mt-4 text-center bg-dark text-white">Gestão de Usuários</div>
                <div class="card-body">
                    <div class="container mt-5">
                        <h1 class="mb-4">Atualizar Usuário</h1>

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('users.update', $user) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" value="{{ $user->name }}" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" value="{{ $user->email }}" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="form-group">
                                <label for="userType">Tipo de Usuário</label>
                                <select name="role" class="form-control" required>
                                    <option value="Usuario" {{ (isset($user->role) && $user->role == 'Usuario') ? 'selected' : '' }}>Usuário</option>
                                    <option value="Admin" {{ (isset($user->role) && $user->role == 'Admin') ? 'selected' : '' }}>Administrador</option>
                                    <option value="Tecnico" {{ (isset($user->role) && $user->role == 'Tecnico') ? 'selected' : '' }}>Técnico</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3" onclick="return confirm('Você têm certeza que quer atualizar este usuário?')">Atualizar</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Voltar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection