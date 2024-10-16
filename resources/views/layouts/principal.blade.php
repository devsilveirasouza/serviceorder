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
</head>

<body>

    <!-- Main Content -->
    <div class="card">
        <div class="d-flex flex-column p-1">
            @if(Auth::user())
            <!-- Navbar Start -->
            <nav class="navbar navbar-dark bg-dark fixed-top">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Ordem de Serviço</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title text-center" id="offcanvasDarkNavbarLabel">MENU</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">

                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}" alt="Home">
                                        <i class="fas fa-home"></i> Home
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('users.index') }}">
                                        <i class="fas fa-users"></i> Usuários
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('clients.index') }}">
                                        <i class="fas fa-user-friends"></i> Clientes
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('services.index') }}">
                                        <i class="fas fa-wrench"></i> Serviços
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('parts.index') }}">
                                        <i class="fas fa-cogs"></i> Peças
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('orders.index') }}">
                                        <i class="fas fa-list"></i> Ordens de Serviço
                                    </a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Financeiro
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-dark">
                                        <li><a class="dropdown-item" href="{{ route('financial.payables') }}">Contas a Pagar</a></li>
                                        <li><a class="dropdown-item" href="{{ route('financial.payables') }}">Contas a Pagar</a></li>
                                        <li><a class="dropdown-item" href="{{ route('payment.methods') }}">Métodos de pagamento</a></li>
                                        <li><a class="dropdown-item" href="{{ route('payment.installments') }}">Parcelamento</a></li>
                                        <li><a class="dropdown-item" href="{{ route('financials.report') }}">Relatórios</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('financial.dashboard') }}">Gráfico</a></li>
                                    </ul>
                                </li>
                                <!-- Logout Option -->
                                <li class="nav-item mt-3">
                                    <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </a>
                                </li>
                                <!-- Formulário oculto de logout -->
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- NavBar End -->
            @endif
        </div>

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