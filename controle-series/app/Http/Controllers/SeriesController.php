<?php 

namespace App\Http\Controllers;

class SeriesController {
    public function index(){

        $series = [
            'Punisher',
            'Lost',
            'Grey/s Anatomy',
        ];

        //passando a chamar view listar-series com o array series
        // return view('listar-series', [
        //     'series' => $series
        // ]);

        //mais simpes e passando pra ela somento oq deve enviar que a variavel $series
        //return view('listar-series',compact('series'));
        return view('series.index') ->with ('series', $series);
    }

    public function create(){
        return view('series.create');
    }

}