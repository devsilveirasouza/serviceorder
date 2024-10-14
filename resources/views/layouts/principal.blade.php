<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Application')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Página específica CSS -->
    @yield('page-css')
    <style>
        .sidebar {
            background-color: #343a40;
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding-top: 20px;
        }

        .sidebar a {
            color: #ffffff;
            font-weight: bold;
            display: block;
            padding: 15px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            margin-left: 250px;
            /* largura da sidebar */
            padding: 20px;
        }
    </style>
</head>

<body>

    <!-- Main Content -->
    <div class="card">
        <div class="d-flex flex-column p-1">

            @if(Auth::user()){
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Outros itens do menu -->
                <ul class="nav flex-column">
                    <!-- Outros links de navegação -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}">
                            <i class="fas fa-users"></i> Usuários
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('clients.index') }}">
                            <i class="fas fa-user-friends"></i> Clientes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('services.index') }}">
                            <i class="fas fa-wrench"></i> Serviços
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('parts.index') }}">
                            <i class="fas fa-cogs"></i> Peças
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('orders.index') }}">
                            <i class="fas fa-list"></i> Ordens de Serviço
                        </a>
                    </li>
                    <hr>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('payment.methods') }}">
                            <i class="fa-solid fa-cash-register"></i> Métodos de Pagamento
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('payment.installments') }}">
                            <i class="fa-solid fa-cash-register"></i> Parcelamentos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('financial.payables') }}">
                            <i class="fa-solid fa-cash-register"></i> Contas á Pagar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('financial.receivables') }}">
                            <i class="fa-solid fa-cash-register"></i> Contas á Receber
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('financials.report') }}">
                            <i class="fa-solid fa-cash-register"></i> Relatório Financeiro
                        </a>
                    </li>
                    
                    <hr>
                    <!-- Logout Option -->
                    <li class="nav-item mt-3">
                        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                </ul>

                <!-- Formulário oculto de logout -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>


        </div>
        } @endif


        <div class="flex-grow-2 mt-3 mb-3 p-3">
            <!-- Aqui será injetado o conteúdo específico de cada página -->
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Página específica JS -->
    @yield('page-js')
</body>

</html>