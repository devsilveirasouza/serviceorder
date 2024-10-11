@extends('layouts.principal')

@section('title', '<i class="ri-user-5-line"></i> Services')

@section('content')

<div style="margin-left: 250px;" class="col-md-10">
    <div class="h-100 p-5 bg-light border rounded-3">
        <h2>{{ $service->name }}</h2>
        
        <hr>
        <label for="price">Preço:</label>
        <p>{{ $service->price }}</p>       
        <hr>
        <label for="created_at">Data de Cadastro</label>
        @if($service->created_at)
        <p>{{ date_format($service->created_at, 'd/m/Y') }}</p>
        @else
        <p>Não disponível</p>
        @endif
        <hr>
        <a href="{{ route('services.index') }}" class="btn btn-outline-primary" type="button">Voltar</a>
    </div>
</div>

@endsection