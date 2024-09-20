@extends('layouts.principal')

@section('title', 'Create Vehicle')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="p-1">
            <div class="card col-md-6">

                <div class="card-header mt-4 text-center bg-dark text-white">Gestão de Veículos</div>

                <div class="card-body">
                    <div class="container mt-5">
                        <h1 class="mb-4">Cadastrar Veículos</h1>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('vehicles.store') }}" method="POST" >
                            @csrf
                            @include('admin.vehicles._form', ['clients' => $clients])
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection