<x-layout title="Episódios">

    
    <form method="post">
        @csrf
        <ul class="list-group">
            @foreach ($episodes as $episode)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                        Episodio {{ $episode->number }}

                        <input type="checkbox" name="episodes[]" value="{{$episode->id}}">
        
                </li>
            @endforeach
        </ul>

        <button class="btn btn-primary mt-2 mb-2">Salvar</button>
    </form>
</x-layout>
