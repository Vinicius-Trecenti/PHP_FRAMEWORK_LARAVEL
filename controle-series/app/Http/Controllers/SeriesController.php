<?php


namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Models\Episode;
use App\Models\Season;
use App\Repositories\SeriesRepository;
use Illuminate\Foundation\Events\PublishingStubs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LDAP\Result;

class SeriesController extends Controller
{

    //contrutor
    public function __construct(private SeriesRepository $repository){

    }


    public function index(Request $request)
    {

        //um select no banco de dados
        //$series = Serie::all();
        // $series = Serie::query()->orderBy('nome')->get();

        $series = Series::with(['seasons'])->get();

        $mensagemSucesso = $request->session()->get('mensagem.sucesso');

        $request->session()->forget('mensagem.sucesso');

        //retorna uma query - coleçao que pegamos com o metodo get
        //temos o query()->orderBy('nome', 'desc')->get();

        //var_dump($series);
        //dd($series);//importante para debugar -> encerra a view

        //passando a chamar view listar-series com o array series
        // return view('listar-series', [
        //     'series' => $series
        // ]);

        //mais simpes e passando pra ela somento oq deve enviar que a variavel $series
        //return view('listar-series',compact('series'));

        //Uma forma de consultar o banco
        //$series = DB::select('SELECT nome FROM series');



        return view('series.index')->with('series', $series)->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create()
    {
        return view('series.create');
    }

    //algum erro na hora de inserir no banco de dados
    // public function store(SeriesFormRequest $request){

    //     // $nomeSerie = $request->input('nome');

    //     // $serie = new Serie();
    //     // $serie->nome = $nomeSerie;
    //     // $serie->save();

    //     //essa parte envia para o banco criar, porem precisa declarar no model que o token nao vai
    //     // $request->validate([
    //     //     'nome'=> ['required', 'min:3']
    //     // ]);

    //     //TODOS OS DADOS CONTINUAM FUNCIONANDO COM O NOVO REQUEST -> POSSUINDO APENAS A VALIDAÇÃO INCLUIODA
    //     $seriecriada = Series::create($request->all());


    //     $season = [];
    //     //para cada temporada
    //     for($i = 1; $i <= $request->seasonQty; $i++){
    //         //criar no banco a temporada - utilizando o relacionamento
    //         $season[] = [
    //             'series_id' => $seriecriada->id,
    //             'number' => $i,
    //         ];

    //         // $season = $seriecriada->seasons()->create([
    //         //     'number' => $i,
    //         // ]);

    //     }
    //     //inserindo passando o array com as temporadas
    //     Season::insert($season);

    //         // $season = $seriecriada->seasons()->create([
    //         //     'number' => $i,
    //         // ]);

    //         //para cada temporada criar os episodios

    //     //buscar todas as seasons
    //     $episodes = [];
    //     foreach($seriecriada->seasons as $season){

    //         for($j = 1; $j<= $request->episodesPerSeason; $j++){
    //             //criando os episodios
    //             //porem temos que configurar o mass assignment 
    //             $episodes[] = [
    //                 'season_id' => $season->id,
    //                 'number' => $j,
    //             ];

    //         }
    //     }

    //     Episode::insert($episodes);







    //     //com erro porem funciona a funcao flash
    //     $request->session()->flash('mensagem.sucesso',"Série '{$seriecriada->nome}' criada com sucesso");
    //     //dd($request->all());

    //     //tipos de redirect
    //     // return redirect(route('series.index'));
    //     return to_route('series.index');


    //     // if(DB::insert('INSERT INTO series (nome) VALUES (?)', [$nomeSerie])){
    //     //     return redirect('/series')->with('success');
    //     // }else{
    //     //     return "Erro na inserção";
    //     // };

    //     // if (DB::insert('INSERT INTO series (nome) VALUES (?)', [$nomeSerie])){
    //     //     return "Serie inserida!";
    //     // }else{ 
    //     //     return "Erro na inserção da serie";
    //     // }
    // }

    //O laravel se localiza por nomes, podemos passar tanto um model, quanto um int $serie como id
    //ou podemos usar o request normalmente

    public function store(SeriesFormRequest $request, SeriesRepository $repository){

        //  $serie = $repository->add($request);
        $serie = $this->repository->add($request);


        return to_route('series.index')->with('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso");
    }

    public function destroy(Request $request, Series $series)
    {

        // $seriedeletada = Serie::find($request->series);
        // dd($seriedeletada);

        $series->delete();

        // dd($request->route());
        // Serie::destroy($request->series);
        $serieremovida = $request->series->Nome;


        //$request->session()->flash('mensagem.sucesso', "Série: '{$serieremovida}'removida com sucesso");
        // $request->session()->flash('mensagem.sucesso','Série removida com sucesso');


        //posso retornar a flash mensg com with e os parametros alem de variaveis.
        return to_route('series.index')->with('mensagem.sucesso', "Série: '{$serieremovida}' removida com sucesso");
    }

    public function edit(Series $series)
    {


        return view('series.edit')->with('serie', $series);
    }

    public function update(SeriesFormRequest $request, Series $series)
    {

        // $series->nome = $request->nome;
        // $series->save();

        $series->fill($request->all());
        $series->save();

        return to_route('series.index')->with('mensagem.sucesso', "Série {$series->nome} atualizada");
    }
}
