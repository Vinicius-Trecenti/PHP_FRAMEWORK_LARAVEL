<link rel="stylesheet" href= "{{asset('css/app.css')}}">
<link rel="stylesheet" href= "{{asset('css/estilos.css')}}"> 
<script src="{{ asset('js/app.js') }}"></script>
@component('mail::message')

# {{$nomeSerie}} foi criada

A serie {{$nomeSerie}} com {{$qtdTemporadas}} temporadas e {{$episodiosPorTemporada}} episodios foi criada

Acesse aqui:

@component('mail::button', ['url' => route('seasons.index', $idSerie )])
    Ver serie
@endcomponent

@endcomponent