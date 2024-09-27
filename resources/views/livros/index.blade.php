@extends('layout')

@section('title', 'Lista de Livros')

@section('content')
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">
                <i class="bi bi-book"></i> Lista de Livros
            </h4>
            <a href="{{ route('livros.create') }}" class="btn btn-success btn-sm">
                Cadastrar Novo Livro
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('livros.index') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Buscar livro..." value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                </div>
            </form>

            @if($livros->isEmpty())
                @if(request('search'))
                    <div class="alert alert-warning" role="alert">
                        Nenhum livro cadastrado ou encontrado para a busca realizada.
                    </div>
                @else
                    <div class="alert alert-warning" role="alert">
                        Nenhum livro cadastrado, clique em <strong>Cadastrar Novo Livro</strong> para começar.
                    </div>
                @endif
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 30%;">Título</th>
                            <th style="width: 18%;">Editora</th>
                            <th style="width: 5%;">Edição</th>
                            <th style="width: 15%;">Ano de Pub.</th>
                            <th style="width: 15%;">Valor</th>
                            <th style="width: 12%;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($livros as $livro)
                            <tr>
                                <td>{{ $livro->Titulo }}</td>
                                <td>{{ $livro->Editora }}</td>
                                <td>{{ $livro->Edicao }}ª</td>
                                <td>{{ $livro->AnoPublicacao }}</td>
                                <td>R$ {{ number_format($livro->Valor, 2, ',', '.') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('livros.edit', $livro->CodLi) }}" class="btn btn-warning btn-sm rounded-circle btn-index" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm rounded-circle delete-btn btn-index" data-action-url="{{ route('livros.destroy', $livro->CodLi) }}" title="Excluir">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>

@include('components.modal_confirm_delete')


<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                Livro excluído com sucesso!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
@endsection
