@extends('layouts.principal')

@section('title', 'Users')

@section('page-css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="p-1">
            <div class="card-body">
                <div class="container mt-5">
                    <h3 class="mb-4">Lista de Usuários
                        <a href="{{ route('users.create') }}" class="btn btn-primary float-end">Novo</a>
                    </h3>
                    <!-- Inicio do Toast ==================================================================================== -->
                    <!-- Toast HTML -->
                    <div class="position-fixed top-0 end-0 mt-5 p-3" style="z-index: 11">
                        <!-- Toast de sucesso -->
                        @if(session('success'))
                        <div id="toast-success" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    {{ session('success') }}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif

                        <!-- Toast de erro -->
                        @if(session('error'))
                        <div id="toast-error" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    {{ session('error') }}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- Fim do Toast ======================================================================================= -->
                    <table id="users-table" class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <!-- <th>ID</th> -->
                                <th>Usuário</th>
                                <th>Email</th>
                                <th>Tipo de Usuário</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <!-- <td>{{ $user->id }}</td> -->
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-eye"></i></a>
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Você têm certeza que quer apagar este registro?')"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page-js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<!-- Script para exibir o Toast -->
<script>
    // Verificar e exibir toast de sucesso
    @if(session('success'))
    var toastSuccessEl = document.getElementById('toast-success');
    var toastSuccess = new bootstrap.Toast(toastSuccessEl);
    toastSuccess.show();
    @endif

    // Verificar e exibir toast de erro
    @if(session('error'))
    var toastErrorEl = document.getElementById('toast-error');
    var toastError = new bootstrap.Toast(toastErrorEl);
    toastError.show();
    @endif
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#users-table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "order": [
                [0, "desc"]
            ],
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "columnDefs": [{
                "orderable": false,
                "targets": -1
            }],
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                },
                "select": {
                    "rows": {
                        "_": "Selecionado %d linhas",
                        "0": "Nenhuma linha selecionada",
                        "1": "Selecionado 1 linha"
                    }
                },
            }
        });
    });
</script>

@endsection