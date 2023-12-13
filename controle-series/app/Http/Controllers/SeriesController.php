<?php 


namespace App\Http\Controllers;
use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LDAP\Result;

class SeriesController extends Controller{
    public function index(Request $request){

        //um select no banco de dados
        //$series = Serie::all();
        $series = Serie::query()->orderBy('nome')->get();

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

    public function create(){
        return view('series.create'); 
    }

    public function store(Request $request){

        // $nomeSerie = $request->input('nome');

        // $serie = new Serie();
        // $serie->nome = $nomeSerie;
        // $serie->save();

        //essa parte envia para o banco criar, porem precisa declarar no model que o token nao vai
        Serie::create($request->all(''));

        //com erro porem funciona a funcao flash
        $request->session()->flash('mensagem.sucesso','Série criada com sucesso');
        //dd($request->all());

        //tipos de redirect
        // return redirect(route('series.index'));
        return to_route('series.index');


        // if(DB::insert('INSERT INTO series (nome) VALUES (?)', [$nomeSerie])){
        //     return redirect('/series')->with('success');
        // }else{
        //     return "Erro na inserção";
        // };

        // if (DB::insert('INSERT INTO series (nome) VALUES (?)', [$nomeSerie])){
        //     return "Serie inserida!";
        // }else{ 
        //     return "Erro na inserção da serie";
        // }
    }

    public function destroy(Request $request){

        // dd($request->route());
        Serie::destroy($request->series);
        $request->session()->put('mensagem.sucesso','Série removida');
        // $request->session()->flash('mensagem.sucesso','Série removida com sucesso');

        return to_route('series.index');
    }

}