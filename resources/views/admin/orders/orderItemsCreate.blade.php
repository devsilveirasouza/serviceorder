@extends('layouts.principal')

@section('content')
<div class="container mt-5">
    <h2>Adicionar Itens à Ordem de Serviço #{{ $order->id }}</h2>

    <form action="{{ route('orderItems.store') }}" method="POST">
        @csrf

        <!-- Ordem de Serviço (hidden) -->
        <input type="hidden" name="order_id" value="{{ $order->id }}">

        <!-- Cliente (somente leitura) -->
        <div class="form-group">
            <label for="client_id">Cliente</label>
            <input type="text" class="form-control" value="{{ $client->name }}" readonly>
            <input type="hidden" name="client_id" value="{{ $client->id }}">
        </div>

        <!-- Veículo (somente leitura) -->
        <div class="form-group">
            <label for="vehicle_id">Veículo</label>
            <input type="text" class="form-control" value="{{ $vehicle->model }} - {{ $vehicle->plate }}" readonly>
            <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
        </div>

        <!-- Serviços -->
        <div class="form-group">
            <label for="service_id">Serviços</label>
            <table class="table" id="service_table">
                <!-- Tabela dos serviços -->
            </table>
            <!-- Botão para adicionar um serviço -->
            <button type="button" id="add_service_row" class="btn btn-primary">Adicionar Serviço</button>
        </div>

        <!-- Peças -->
        <div class="form-group">
            <label for="part_id">Peças</label>
            <table class="table" id="part_table">
                <!-- Tabela das peças -->
            </table>
            <!-- Botão para adicionar uma peça -->
            <button type="button" id="add_part_row" class="btn btn-primary">Adicionar Peça</button>
        </div>

        <!-- Botão para Salvar -->
        <div class="mt-2">
            <button type="submit" class="btn btn-primary">Salvar Itens</button>
        </div>

    </form>
</div>

<!-- Adicionar jQuery no cabeçalho (antes de qualquer script JS que dependa dele) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Seu código JavaScript -->
<script>
    $(document).ready(function() {
        // Adicionar novo serviço na tabela
        $('#add_service_row').click(function() {
            $('#service_table').append(`
            <tr>
                <td>
                    <select name="service_id[]" class="form-control">
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }} - {{ $service->price }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" name="service_qty[]" class="form-control" value="1" min="1">
                </td>
                <td>
                    <button type="button" class="btn btn-danger remove_row">Remover</button>
                </td>
            </tr>
        `);
        });

        // Adicionar nova peça na tabela
        $('#add_part_row').click(function() {            
            $('#part_table').append(`
            <tr>
                <td>
                    <select name="part_id[]" class="form-control">
                        @foreach($parts as $part)
                            <option value="{{ $part->id }}">{{ $part->name }} - {{ $part->price }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" name="part_qty[]" class="form-control" value="1" min="1">
                </td>
                <td>
                    <button type="button" class="btn btn-danger remove_row">Remover</button>
                </td>
            </tr>
        `);
        });

        // Remover linha de serviço ou peça
        $(document).on('click', '.remove_row', function() {
            $(this).closest('tr').remove();
        });
    });
</script>

@endsection