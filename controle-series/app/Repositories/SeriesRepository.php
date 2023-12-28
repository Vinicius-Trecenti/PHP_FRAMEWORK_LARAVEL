<?php

namespace App\Repositories;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;

interface SeriesRepository{

    //uma interface para um repositorio de series
    public function add(SeriesFormRequest $request): Series;
}