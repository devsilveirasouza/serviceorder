@extends('layouts.principal')

@section('title', 'Login')

@section('css')
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Awesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                <!-- Coluna esquerda (Imagem ou algo mais) -->
                <div class="col-md-6 d-none d-md-block bg-light text-center">
                    <div class="mt-5">
                        <img src="https://via.placeholder.com/500" class="img-fluid" alt="Imagem de Login">
                        <h2 class="mt-3">Bem-vindo de volta!</h2>
                        <p>Por favor, entre com suas credenciais</p>
                    </div>
                </div>

                <!-- Coluna direita (Formulário de login) -->
                <div class="col-md-6 bg-white p-5">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4>{{ __('Login') }}</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Email -->
                                <div class="form-group mb-3">
                                    <label class="text-center m-2" for="email">Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- Senha -->
                                <div class="form-group mb-3">
                                    <label class="text-center m-2" for="password">Senha</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- Lembrar de mim -->
                                <div class="form-group mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>

                                <!-- Botão de Login -->
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-primary btn-block w-100">
                                        {{ __('Login') }}
                                    </button>
                                </div>

                                <!-- Link para recuperação de senha -->
                                @if (Route::has('password.request'))
                                <div class="mt-2 text-center">
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div> <!-- Coluna direita fim -->
            </div> <!-- Fim da row -->
        </div>
    </div>
</div>
@endsection