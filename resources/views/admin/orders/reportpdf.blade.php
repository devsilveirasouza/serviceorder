<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ordem de Serviço</title>
    <!-- PDF CSS -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
        
        body {
            font-family: Roboto, sans-serif;
            font-size: 14px;
        }

        h4 {
            margin: 0;
        }

        .w-full {
            width: 100%;
        }

        .w-half {
            width: 50%;
        }

        .margin-top {
            margin-top: 1.25rem;
        }

        .footer {
            font-size: 0.875rem;
            padding: 1.2rem;
            background-color: rgb(241 245 249);
            position: fixed;
            bottom: 0;
            width: 95%;
        }

        table {
            width: 100%;
            border-spacing: 0;
        }

        table.products {
            font-size: 0.875rem;
        }

        table.products tr {
            background-color: rgb(96 165 250);
        }

        table.products th {
            color: #ffffff;
            padding: 0.5rem;
        }

        table tr.items {
            background-color: rgb(241 245 249);
        }

        table tr.items td {
            padding: 0.5rem;
        }

        .total {
            text-align: right;
            margin-top: 1rem;
            font-size: 0.875rem;
        }

        .text-center {
            text-align: center;
        }
    </style>

</head>

<body>
    <table class="w-full">
        <tr>
            <td class="w-half">
                <h2>Ordem de Serviço: {{ $order->id }}</h2>
                <p>Data de Emissão: {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</p>
                <p>Status: {{ $order->status }}</p>
                <p>Atendente: {{ $order->user->name }}</p>
            </td>

            <td class="w-half">
                <h3>OFICINA XYZ</h3>
                <p>Av. Central n° 999</p>
                <p>Porto Alegre, RS - Brasil</p>
                <p>CEP: 99999-999 | Fone: (51) 99999-9999</p>
            </td>

        </tr>
    </table>

    <hr>

    <div class="margin-top">
        <table class="w-full">
            <tr>
                <td class="w-half">
                    <div>
                        <h4>Cliente:</h4>
                    </div>
                    <div>{{ $order->client->name }}</div>
                    <div>{{ $order->client->email }}</div>
                    <div>{{ $order->client->phone }}</div>
                </td>

                <td class="w-half">
                    <div>
                        <h4>Veículo:</h4>
                    </div>
                    <div>Marca: {{ $order->vehicle->brand }}</div>
                    <div>Modelo: {{ $order->vehicle->model }}</div>
                    <div>Placa: {{ $order->vehicle->plate }}</div>
                </td>
            </tr>
        </table>
    </div>

    <hr>

    <div class="margin-top">

        <table class="products margin-top">
            <tr>
                <th>Descrição</th>
                <th>Quantidade</th>
                <th>Preço Unitário</th>
                <th>Sub Total</th>
            </tr>

            @foreach($order->parts as $part)
            <tr class="items">
                <td>{{ $part->part->name }}</td>
                <td class="text-center">{{ $part->quantity }}</td>
                <td class="text-center">R$ {{ number_format($part->unit_price, 2, ',', '.') }}</td>
                <td class="text-center">R$ {{ number_format($part->total_price, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </table>

        <table class="products margin-top">
            <tr>
                <th>Descrição</th>
                <th>Quantidade</th>
                <th>Preço Unitário</th>
                <th>Sub Total</th>
            </tr>
            @foreach($order->services as $service)
            <tr class="items">
                <td>{{ $service->service->name }}</td>
                <td class="text-center">{{ $service->quantity }}</td>
                <td class="text-center">R$ {{ number_format($service->unit_price, 2, ',', '.') }}</td>
                <td class="text-center">R$ {{ number_format($service->total_price, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <div class="total">
        <table class="products">
            <tr>
                <th class="total">Total: R$ {{ number_format($order->total_price, 2, ',', '.') }}</th>
            </tr>
        </table>
    </div>

    <div class="footer margin-top text-center">
        <div>Criado por:</div>
        <div>&copy; dev.wsilveirasouza@gmail.com 2024</div>
    </div>
</body>

</html>