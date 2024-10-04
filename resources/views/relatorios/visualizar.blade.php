@extends('layout')

@section('content')

<h1>Relatório de {{ ucfirst(str_replace('_', ' ', $tipo)) }}</h1>


@if($livros->isEmpty())
    @if(isset($error))
        <div class="alert alert-warning">
            {{ $error }}
        </div>
    @else
        <div class="alert alert-warning">
            Nenhum resultado encontrado para este relatório.
        </div>
    @endif

    <a href="{{ route('relatorios.index') }}" class="btn btn-secondary">Voltar</a>
@else
    <table class="table table-bordered">
        <thead>
            <tr>
                @isset($livros[0]->Nome) <th>Autor</th> @endisset
                @isset($livros[0]->Titulo) <th>Título</th> @endisset
                @isset($livros[0]->Editora) <th>Editora</th> @endisset
                @isset($livros[0]->Edicao) <th>Edição</th> @endisset
                @isset($livros[0]->AnoPublicacao) <th>Ano de Publicação</th> @endisset
                @isset($livros[0]->Valor) <th>Valor</th> @endisset
                @isset($livros[0]->ValorTotal) <th>Valor Total</th> @endisset
                @isset($livros[0]->ValorMedio) <th>Valor Médio</th> @endisset
                @isset($livros[0]->FaixaDePreco) <th>Faixa de Preço</th> @endisset
                @isset($livros[0]->Assuntos) <th>Assunto</th> @endisset
                @isset($livros[0]->Quantidade) <th>Quantidade</th> @endisset
                @isset($livros[0]->Titulos) <th>Títulos</th> @endisset
            </tr>
        </thead>
        <tbody>
            @foreach($livros as $livro)
                <tr>
                    @isset($livro->Nome) <td>{{ $livro->Nome }}</td> @endisset
                    @isset($livro->Titulo) <td>{{ $livro->Titulo }}</td> @endisset
                    @isset($livro->Editora) <td>{{ $livro->Editora }}</td> @endisset
                    @isset($livro->Edicao) <td>{{ $livro->Edicao }}ª</td> @endisset
                    @isset($livro->AnoPublicacao) <td>{{ $livro->AnoPublicacao }}</td> @endisset
                    @isset($livro->Valor) <td>R$ {{ number_format($livro->Valor, 2, ',', '.') }}</td> @endisset
                    @isset($livro->ValorTotal) <td>R$ {{ number_format($livro->ValorTotal, 2, ',', '.') }}</td> @endisset
                    @isset($livro->ValorMedio) <td>R$ {{ number_format($livro->ValorMedio, 2, ',', '.') }}</td> @endisset
                    @isset($livro->FaixaDePreco) <td>{{ $livro->FaixaDePreco }}</td> @endisset
                    @isset($livro->Assuntos) <td>{{ $livro->Assuntos }}</td> @endisset
                    @isset($livro->Quantidade) <td>{{ $livro->Quantidade }}</td> @endisset
                    @isset($livro->Titulos) <td>{{ $livro->Titulos }}</td> @endisset
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <form action="{{ route('relatorios.gerar') }}" method="GET">
        <input type="hidden" name="tipo" value="{{ $tipo }}">
        <a href="{{ route('relatorios.index') }}" class="btn btn-secondary">Voltar</a>
        <button type="submit" class="btn btn-primary">Exportar para Excel</button>
    </form>

    
@endif

@endsection
