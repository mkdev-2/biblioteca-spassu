@extends('layout')

@section('content')

    <h1>Relatório de {{ ucfirst(str_replace('_', ' ', $tipo)) }}</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                @if(!empty($livros[0]->autor)) <th>Autor</th> @endif
                @if(!empty($livros[0]->titulo)) <th>Título</th> @endif
                @if(!empty($livros[0]->editora)) <th>Editora</th> @endif
                @if(!empty($livros[0]->edicao)) <th>Edição</th> @endif
                @if(!empty($livros[0]->ano_publicacao)) <th>Ano de Publicação</th> @endif
                @if(!empty($livros[0]->valor)) <th>Valor</th> @endif
                @if(!empty($livros[0]->assuntos)) <th>Assunto</th> @endif
            </tr>
        </thead>
        <tbody>
            @foreach($livros as $livro)
                <tr>
                    @if(!empty($livro->autor)) <td>{{ $livro->autor }}</td> @endif
                    @if(!empty($livro->titulo)) <td>{{ $livro->titulo }}</td> @endif
                    @if(!empty($livro->editora)) <td>{{ $livro->editora }}</td> @endif
                    @if(!empty($livro->edicao)) <td>{{ $livro->edicao }}ª</td> @endif
                    @if(!empty($livro->ano_publicacao)) <td>{{ $livro->ano_publicacao }}</td> @endif
                    @if(!empty($livro->valor)) <td>R$ {{ number_format($livro->valor, 2, ',', '.') }}</td> @endif
                    @if(!empty($livro->assuntos)) <td>{{ $livro->assuntos }}</td> @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    <form action="{{ route('relatorios.gerar') }}" method="GET">
        <input type="hidden" name="tipo" value="{{ $tipo }}">
        <button type="submit" class="btn btn-primary">Exportar para Excel</button>
    </form>
@endsection
