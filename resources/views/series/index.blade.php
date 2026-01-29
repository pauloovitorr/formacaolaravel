@extends('layout')


@section('content')
    <a href="{{ route('series.create') }}" class="btn btn-primary mb-3">
        Adicionar
    </a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif


    <div class="mb-3">
        <h1>Séries Cadastradas</h1>
    </div>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Temporadas</th>
                <th>Deletar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($series as $serie)
                <tr>
                    <td>{{ $serie->id }}</td>
                    <td>{{ $serie->titulo }}</td>
                    <td>{{ $serie->temporadas }}</td>

                    <td>
                        <form action="{{ route('series.destroy', $serie->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">X</button>

                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
