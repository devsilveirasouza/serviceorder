@extends('layouts.principal')

@section('content')
<div class="container mt-5">

    <h3 class="mb-4">Atualizar Ordem de Serviço</h3>
    <h4>Nº: {{ $order->id }}</h4>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('ordersItems.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')
        <!-- Ordem de Serviço (hidden) -->
        <input type="hidden" name="order_id" value="{{ $order->id }}">

        <div class="row">
            <!-- Cliente (somente leitura) -->
            <div class="form-group col-md-10">
                <label for="client_id"><strong>Cliente</strong></label>
                <input type="text" class="form-control" value="{{ $client->name }}" readonly>
                <input type="hidden" name="client_id" value="{{ $client->id }}">
            </div>

            <!-- Veículo (somente leitura) -->
            <div class="form-group col-md-2 text-center ">
                <label for="vehicle_id"><strong>Veículo</strong></label>
                <input type="text" class="form-control text-center" value="{{ $vehicle->model }} - {{ $vehicle->plate }}" readonly>
                <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
            </div>
        </div>

        <hr>
        <!-- Serviços -->
        <div class="form-group">
            <label for="services">Serviços</label>
            <table class="table" id="service_table">
                <thead>
                    <tr>
                        <th class="text-center">Serviço</th>
                        <th class="text-center">Quantidade</th>
                        <th class="text-center">Opção</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->services as $orderService)
                    <tr>
                        <td class="col-md-8">
                            <select name="services[]" class="form-control">
                                @foreach($services as $service)
                                <option value="{{ $service->id }}" {{ $service->id == $orderService->service_id ? 'selected' : '' }}>
                                    {{ $service->name }} - R$ {{ $service->price }}
                                </option>
                                @endforeach
                            </select>
                        </td>

                        <td class="col-md-2">
                            <input type="number" name="service_qty[]" class="form-control" value="{{ $orderService->quantity }}" min="1">
                        </td>

                        <td class="col-md-2 text-center">
                            <button type="button" class="btn btn-danger remove_row">Remover</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="button" id="add_service_row" class="btn btn-primary">Adicionar Serviço</button>
        </div>

        
        <!-- Peças -->
        <div class="form-group">
            <label for="parts">Peças</label>
            <table class="table" id="part_table">
                <thead>
                    <tr>
                        <th class="text-center">Peça</th>
                        <th class="text-center">Quantidade</th>
                        <th class="text-center">Opção</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->parts as $orderPart)
                    <tr>
                        <td class="col-md-8">
                            <select name="parts[]" class="form-control">
                                @foreach($parts as $part)
                                <option value="{{ $part->id }}" {{ $part->id == $orderPart->part_id ? 'selected' : '' }}>
                                    {{ $part->name }} - R$ {{ $part->price }}
                                </option>
                                @endforeach
                            </select>
                        </td>

                        <td class="col-md-2">
                            <input type="number" name="part_qty[]" class="form-control" value="{{ $orderPart->quantity }}" min="1">
                        </td>

                        <td class="text-center col-md-2">
                            <button type="button" class="btn btn-danger remove_row">Remover</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="button" id="add_part_row" class="btn btn-primary">Adicionar Peça</button>
        </div>

        <!-- Botão para Salvar -->
        <div class="mt-2">
            <button type="submit" class="btn btn-success">Atualizar</button>
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
            <tr class="form-group">
                <td class="col-md-8">
                    <select name="services[]" class="form-control">
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }} - {{ $service->price }}</option>                       
                        @endforeach
                    </select>
                </td>
                td
                
                <td class="col-md-2">
                    <input type="number" name="service_qty[]" class="form-control" value="1" min="1">
                </td>
                
                <td class="text-center col-md-2">
                    <button type="button" class="btn btn-danger remove_row">Remover</button>
                </td>
            </tr>
        `);
        });

        // Adicionar nova peça na tabela
        $('#add_part_row').click(function() {
            $('#part_table').append(`
            <tr class="form-group">
                <td class="col-md-8">
                    <select name="parts[]" class="form-control">
                        @foreach($parts as $part)
                            <option value="{{ $part->id }}">{{ $part->name }} - {{ $part->price }}</option>
                        @endforeach
                    </select>
                </td>

                <td class="col-md-2">
                    <input type="number" name="part_qty[]" class="form-control" value="1" min="1">
                </td>

                <td class="text-center col-md-2">
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