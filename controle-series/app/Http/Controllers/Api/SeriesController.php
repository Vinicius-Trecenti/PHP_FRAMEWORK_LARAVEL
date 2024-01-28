<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;

class SeriesController extends Controller
{

    public function __construct(private SeriesRepository $seriesRepository) {

    }

    public function index(Request $request){
        $query = Series::query();

        if($request->has('nome')){
            return $query->where('nome', $request->nome);
        }


        return $query->paginate(5);
    }

    public function store(SeriesFormRequest $request){
       
        // return response()->json(Series::create($request->all()), 201);   
        return response()->json($this->seriesRepository->add($request), 201);
    }

    public function show(int $series){
        //$series = Series::whereId($series)->with("seasons.episodes")->first(); ou get
        $seriesModel = Series::with('seasons.episodes')->find($series);
        if($seriesModel === null){
            return response()->json(['message' => 'Series not found'], 404);
        }
        return $seriesModel;
    }
 
    public function destroy(int $series, Authenticatable $user){
        dd($user->tokenCan('is_admin'));
        Series::destroy($series);
        return response()->noContent();
    }

    public function update(Series $series, SeriesFormRequest $seriesFormRequest){
        $series->fill($seriesFormRequest->all());
        $series->save();

        return $series;
    }

    public function getSeasons(Series $series){
        return response()->json($series->seasons);
    }

    public function getEpisodes(Series $series){
        return $series->episodes;
    }

}
