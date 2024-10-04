@extends('layout')

@section('title', 'Lista de Autores')

@section('content')
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">
                <i class="bi bi-person-lines-fill"></i> Lista de Autores
            </h4>
            <a href="{{ route('autores.create') }}" class="btn btn-success btn-sm">
                <i class="bi bi-plus-circle"></i> Cadastrar Novo Autor
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('autores.index') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por nome" value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                </div>
            </form>

            @if($autores->isEmpty())
                @if(request('search'))
                    <div class="alert alert-warning" role="alert">
                        Nenhum autor encontrado para a busca realizada.
                    </div>
                @else
                    <div class="alert alert-warning" role="alert">
                        Nenhum autor cadastrado, clique em <strong>Cadastrar Novo Autor</strong> para começar.
                    </div>
                @endif
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 85%;">Nome</th>
                            <th style="width: 15%;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($autores as $autor)
                        <tr>
                            <td>{{ $autor->Nome }}</td>
                            <td class="text-center">
                                <a href="{{ route('autores.edit', $autor->CodAu) }}" class="btn btn-warning btn-sm rounded-circle btn-index" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button class="btn btn-danger btn-sm rounded-circle btn-index delete-btn" data-action-url="{{ route('autores.destroy', $autor->CodAu) }}" title="Excluir">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $autores->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

@include('components.modal_confirm_delete')


<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                Autor excluído com sucesso!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
@endsection
