<x-layout title="Séries">
    @auth
    <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">Adicionar</a>
    @endauth

    @isset($mensagemSucesso)
    <div class="alert alert-success">
        {{ $mensagemSucesso }}
    </div>
    @endisset
    

    <ul class="list-group">

        @foreach ($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-items-center" >
        
            <div class="d-flex align-items-center">
                <img src="{{asset('storage/' . $serie->cover)}}" alt="capa serie" class="img-thumbnail me-3" width="100px">

                @auth<a href="{{ route('seasons.index', $serie->id)}}">@endauth
                    {{ $serie->Nome}}
                </a>
            </div>
            
            @auth
            <span class="d-flex">

                
                <a href="{{route('series.edit', $serie->id)}}">
                    <button class="btn btn-primary btn-sm">
                        edit
                    </button>
                </a>
    

                <form action="{{route('series.destroy', $serie->id)}}" method="post" class="ms-2">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">
                        x
                    </button>  
                </form>
            </span>
            @endauth

        </li>
        @endforeach

        
    </ul>
</x-layout>