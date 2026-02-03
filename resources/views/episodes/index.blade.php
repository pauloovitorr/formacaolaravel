@extends('layout')

@section('content')

<a href="{{ route('series.index') }}" class="btn btn-secondary mb-3">
    ← Voltar para listagem
</a>

<div class="mb-3">
    <h1>Episódios</h1>
</div>

<form method="POST" action="{{ route('episodes.update', $seasons ) }}">
    @csrf
    @method('put')

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Número do Episódio</th>
                <th>Selecionar</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($episodes as $episode)
                <tr>
                    <td>{{ $episode->id }}</td>
                    <td>{{ $episode->number }}</td>
                    <td class="text-center">
                        <input
                            type="checkbox"
                            name="episodes[]"
                            value="{{ $episode->id }}"
                            @if ($episode->watched)
                                checked
                            @endif
                        >
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center text-muted">
                        Nenhum episódio encontrado
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <button type="submit" class="btn btn-primary">
        Salvar
    </button>
</form>

@endsection
