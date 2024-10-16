@extends('layouts.principal')

@section('title', '<i class="ri-user-5-line"></i> Clients')

@section('content')

<div style="margin-left: 250px;" class="col-md-10">
    <div class="h-100 p-5 bg-light border rounded-3">
        <h2>{{ $part->name }}</h2>
        
        <hr>
        <label for="price">Preço:</label>
        <p>{{ $part->price }}</p>
        <label for="quantity_in_stock">Quantidade</label>
        <p>{{ $part->quantity_in_stock }}</p>
        <hr>
        <label for="created_at">Data de Cadastro</label>
        @if ($part->created_at)
        <p>{{ date_format($part->created_at, 'd/m/Y') }}</p>
        @else
        <p>Não informado</p>
        @endif
        <label for="updated_at">Data de Atualização</label>
        @if ($part->updated_at)
        <p>{{ date_format($part->updated_at, 'd/m/Y') }}</p>
        @else
        <p>Não informado</p>
        @endif
        <hr>
        <a href="{{ route('parts.index') }}" class="btn btn-outline-primary" type="button">Voltar</a>
    </div>
</div>

@endsection