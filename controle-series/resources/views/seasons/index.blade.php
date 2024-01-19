<x-layout title="Temporadas">

    <div class="d-flex justify-center">
        <img src="{{ asset('storage/' . $series->cover) }}" alt="capa da série" class="img-fluid mb-5" height="500px" width="500">
    </div>

    <ul class="list-group">
        @foreach ($seasons as $season)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{route('episodes.index', $season->id)}}">
                    Temporada {{ $season->number }}
                </a>
                
                <span class="badge bg-secondary">
                    {{$season->numberOfWatchedEpisodes()}}/ {{ $season->episodes->count() }}
                </span>
            </li>
        @endforeach
    </ul>
</x-layout>
