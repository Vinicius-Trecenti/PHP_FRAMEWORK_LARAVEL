<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Http\Request;
use App\Models\Season;

class EpisodesController extends Controller
{
    public function index(Season $season){

        return view('episodes.index', [
            'episodes'=>$season->episodes,
            'mensagemSucesso' => session('mensagem.sucesso')
        ]);
    }

    public function update(Request $request, Season $season){

        $watchedEpisodes = $request->episodes;
        

        $season->episodes->each(function(Episode $episode) use ($watchedEpisodes){
            //se estiver dentro do array ele retorna true entao seta como assistido
            $episode->watched = in_array($episode->id, $watchedEpisodes);
            //$episode->save();
        });
        //pega todos os episodios e salva
        $season->push();

        return to_route('episodes.index', $season->id)->with('mensagem.sucesso', "Episodio marcado com sucesso");
    }

}
