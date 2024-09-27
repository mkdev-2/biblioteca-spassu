@extends('layout')

@section('content')
    <h1>Gerar Relatórios</h1>

    <form action="{{ route('relatorios.visualizar') }}" method="GET">
        <div class="form-group">
            <label for="tipo">Selecione o Tipo de Relatório:</label>
            <select id="tipo" name="tipo" class="form-control">
                <option value="livros_por_autor">Livros por Autor</option>
                <option value="livros_por_assunto">Livros por Assunto</option>
                <option value="livros_disponiveis">Livros Disponíveis</option>
                <option value="livros_por_ano">Livros por Ano de Publicação</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Visualizar Relatório</button>
    </form>
@endsection
