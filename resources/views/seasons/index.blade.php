@extends('layout')


@section('content')
    <a href="{{ route('series.index') }}" class="btn btn-secondary mb-3">
    ← Voltar para listagem
</a>

    <div class="mb-3">
        <h1>Séries Cadastradas</h1>
    </div>

  <table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Temporada {{ $series->titulo }}</th>
            <th>Episódios</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($seasons as $season)
            <tr>
                <td>{{ $season->id }}</td>
                <td>{{ $season->number }}</td>
                <td>{{ $season->episodes->count() }}</td>
               
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center text-muted">
                    Nenhuma Temporada
                </td>
            </tr>
        @endforelse
    </tbody>
</table>



@endsection
