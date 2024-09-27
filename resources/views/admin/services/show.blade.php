@extends('layouts.principal')

@section('title', '<i class="ri-user-5-line"></i> Services')

@section('content')

<div class="col-md-12">
    <div class="h-100 p-5 bg-light border rounded-3">
        <h2>{{ $service->name }}</h2>
        
        <hr>
        <label for="price">Preço:</label>
        <p>{{ $service->price }}</p>       
        <hr>
        <a href="{{ route('services.index') }}" class="btn btn-outline-primary" type="button">Voltar</a>
    </div>
</div>

@endsection