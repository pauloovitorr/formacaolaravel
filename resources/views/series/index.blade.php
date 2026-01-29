@extends('layout')


@section('content')
    <a href="{{ route('series.create') }}" class="btn btn-primary mb-3">
        Adicionar
    </a>

    <div class="mb-3">
        <h1>Séries Cadastradas</h1>
    </div>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Temporadas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($series as $serie)
                <tr>
                    <td>{{ $serie->id }}</td>
                    <td>{{ $serie->titulo }}</td>
                    <td>{{ $serie->temporadas }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
