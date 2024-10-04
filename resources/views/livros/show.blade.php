@extends('layout')

@section('title', 'Detalhes do Livro')

@section('content')
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title mb-0">
                <i class="bi bi-book"></i> 
                Detalhes do Livro: {{ $livro->Titulo }}
            </h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input
                        type="text"
                        class="form-control"
                        id="titulo"
                        name="Titulo"
                        value="{{ $livro->Titulo }}"
                        readonly
                    >
                </div>

                <div class="col-md-6 mb-3">
                    <label for="editora" class="form-label">Editora</label>
                    <input
                        type="text"
                        class="form-control"
                        id="editora"
                        name="Editora"
                        value="{{ $livro->Editora }}"
                        readonly
                    >
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="edicao" class="form-label">Edição</label>
                    <input
                        type="text"
                        class="form-control"
                        id="edicao"
                        name="Edicao"
                        value="{{ $livro->Edicao }}"
                        readonly
                    >
                </div>

                <div class="col-md-4 mb-3">
                    <label for="anoPublicacao" class="form-label">Ano de Publicação</label>
                    <input
                        type="text"
                        class="form-control"
                        id="anoPublicacao"
                        name="AnoPublicacao"
                        value="{{ $livro->AnoPublicacao }}"
                        readonly
                    >
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="valor" class="form-label">Valor</label>
                    <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input
                            type="text"
                            class="form-control"
                            id="valor"
                            name="Valor"
                            value="{{ number_format($livro->Valor, 2, ',', '.') }}"
                            readonly
                        >
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="autores" class="form-label">Autores</label>
                    <ul class="list-group">
                        @foreach ($livro->autores as $autor)
                            <li class="list-group-item">{{ $autor->Nome }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="assuntos" class="form-label">Assuntos</label>
                    <ul class="list-group">
                        @foreach ($livro->assuntos as $assunto)
                            <li class="list-group-item">{{ $assunto->Descricao }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            
            <a href="{{ route('livros.index') }}" class="btn btn-secondary">Voltar</a>
            <a href="{{ route('livros.edit', $livro->CodLi) }}" class="btn btn-primary">Editar Livro</a>
        </div>
    </div>
</div>
@endsection
