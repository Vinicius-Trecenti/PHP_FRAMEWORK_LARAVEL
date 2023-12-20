<x-layout title="Séries">
    <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">Adicionar</a>

    @isset($mensagemSucesso)
    <div class="alert alert-success">
        {{ $mensagemSucesso }}
    </div>
    @endisset
    

    <ul class="list-group">

        @foreach ($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-items-center" >
            <a href="{{ route('seasons.index', $serie->id)}}"> 
                {{ $serie->Nome}}
            </a>

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
        </li>
        @endforeach

        
    </ul>
</x-layout>