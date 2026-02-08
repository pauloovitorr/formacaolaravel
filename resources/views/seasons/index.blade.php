@extends('layout')


@section('content')
    <a href="{{ route('series.index') }}" class="btn btn-secondary mb-3">
    ← Voltar para listagem
</a>

    <div class="mb-3">
        <h1>Séries Cadastradas</h1>
    </div>

    <div class="mb-3">
        <img src="{{ asset('storage/' . $series->cover ) }}" style="max-width: 400px" alt="" srcset="">
    </div>

  <table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Temporada {{ $series->titulo }}</th>
            <th>Episódios</th>
            <th>Assistidos</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($seasons as $season)
            <tr>
                <td>{{ $season->id }}</td>
                <td> <a href="{{ route('episodes.index', $season->id) }}">{{ $season->number }}</a> </td>
                <td>{{ $season->episodes->count() }}</td>
                <td>{{ $season->numberOfWatchedEpisodes() }}</td>
               
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
