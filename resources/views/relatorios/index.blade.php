@extends('layout')

@section('content')
    <h1>Gerar Relatórios</h1>

    @if(session('error'))
        <div class="alert alert-warning" role="alert">
            {{ session('error') }}
        </div>
    @elseif($livros->isEmpty())
        <div class="alert alert-warning" role="alert">
            Não há dados disponíveis para gerar relatórios. Faça seus primeiros cadastros e tente novamente.
        </div>
    @else
        <form action="{{ route('relatorios.visualizar') }}" method="GET">
            <div class="form-group">
                <label for="tipo">Selecione o Tipo de Relatório:</label>
                <select id="tipo" name="tipo" class="form-control">
                    <option value="livros_por_autor">Livros por Autor</option>
                    <option value="livros_por_assunto">Livros por Assunto</option>
                    <option value="livros_por_editora">Livros por Editora</option>
                    <option value="livros_por_ano">Livros por Ano de Publicação</option>
                    <option value="livros_mais_recentes">Livros Mais Recentes</option>
                    <option value="valor_total_por_autor">Valor Total de Livros por Autor</option>
                    <option value="livros_por_faixa_preco">Livros por Faixa de Preço</option>
                    <option value="livros_multiplos_autores">Livros com Múltiplos Autores</option>
                    <option value="autores_mais_publicacoes">Autores com Mais Publicações</option>
                    <option value="assuntos_mais_livros">Assuntos com Mais Livros Associados</option>
                </select>
            </div>
            <a href="{{ url('/') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Visualizar Relatório</button>
        </form>
    @endif
@endsection