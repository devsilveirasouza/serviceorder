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
</head>

<body>

    <!-- Main Content -->
    <div class="card">
        <div class="d-flex flex-column p-1">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top text-white">
                <div class="container-fluid">

                    <span class="fs-4">Ordem de Serviço</span>

                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('users.index') }}">Usuários</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('clients.index') }}">Clientes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('vehicles.index') }}">Veiculos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">Produtos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">Categorias</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
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