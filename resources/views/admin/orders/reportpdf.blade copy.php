<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Goofle Font Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">


    <title>Ordem de Serviço</title>
    <style>
        body {
            font-family: Roboto, sans-serif;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        ul li {
            list-style-type: none;
            text-decoration: none;
        }

        .box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .box-items {
            width: 30%;
            background-color: #f1f1f1;
            text-align: center;
            border: 1px solid #ccc;
        }

        .total {
            text-align: right;
            margin-top: 1rem;
            font-size: 0.875rem;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="row">

            <!-- Informações da Ordem de Serviço -->
            <div class="justify-content-start col-md-12">
                <h2 class="mb-4 text-center">Ordem de Serviço: {{ $order->id }}</h2>
            </div>

        </div>

        <hr>

        <!-- Informações do Cliente e Veículo -->
        <div class="row mb-4 box">
            <div class="box-items col-md-4">
                <h5>Dados do Cliente</h5>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Nome: </strong>{{ $order->client->name }}</li>
                    <li class="list-group-item"><strong>Email: </strong>{{ $order->client->email }}</li>
                    <li class="list-group-item"><strong>Telefone: </strong>{{ $order->client->phone }}</li>
                </ul>
            </div>


            <!-- Dados do Veículo -->
            <div class="box-items col-md-4">
                <h5>Dados do Veículo</h5>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Placa: </strong>{{ $order->vehicle->plate }}</li>
                    <li class="list-group-item"><strong>Marca: </strong>{{ $order->vehicle->brand }}</li>
                    <li class="list-group-item"><strong>Modelo: </strong>{{ $order->vehicle->model }}</li>
                </ul>
            </div>

            <!-- Status -->
            <div class="box-items col-md-4">
                <h5>Informações Gerais</h5>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Usuário: </strong>{{ $order->user->name }}</li>
                    <li class="list-group-item"><strong>Data: </strong>{{ $order->created_at->format('d/m/Y') }}</li>
                    <li class="list-group-item"><strong>Status: </strong>{{ $order->status }}</li>
                </ul>
            </div>
        </div>

        <hr>
        <!-- Peças Utilizadas -->
        <h5 class="mt-4 text-center"><strong>Peças Utilizadas</strong></h5>
        @if($order->parts->isEmpty())
        <p>Nenhuma peça adicionada a esta ordem.</p>
        @else
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th class="col-md-7">Descrição</th>
                    <th class="text-center col-md-1">Quantidade</th>
                    <th class="text-center col-md-2">Preço Unitário</th>
                    <th class="text-center col-md-2">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->parts as $part)
                <tr>
                    <td>{{ $part->part->name }}</td>
                    <td class="text-center">{{ $part->quantity }}</td>
                    <td class="text-center">R$ {{ number_format($part->unit_price, 2, ',', '.') }}</td>
                    <td class="text-center">R$ {{ number_format($part->total_price, 2, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        <!-- Serviços Realizados -->
        <h5 class="mt-4 text-center"><strong>Serviços Realizados</strong></h5>
        @if($order->services->isEmpty())
        <p>Nenhum serviços adicionado a esta ordem.</p>
        @else
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th class="col-md-7">Descrição</th>
                    <th class="text-center col-md-1">Quantidade</th>
                    <th class="text-center col-md-2">Preço Unitário</th>
                    <th class="text-center col-md-2">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->services as $service)
                <tr>
                    <td>{{ $service->service->name }}</td>
                    <td class="">{{ $service->quantity }}</td>
                    <td class="text-center">{{ number_format($service->unit_price, 2, ',', '.') }}</td>
                    <td class="text-center">{{ number_format($service->total_price, 2, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif

        <hr>

        <div class="total row justify-content-end">
            <div class="col-md-2 mr-2">
                <ul class="list-group text-center">
                    <li class="list-group-item"><strong>Valor Total</strong></li>
                    <li class="list-group-item">R$ {{ number_format($order->total_price, 2, ',', '.') }}</li>
                </ul>
            </div>
        </div>

</body>

</html>