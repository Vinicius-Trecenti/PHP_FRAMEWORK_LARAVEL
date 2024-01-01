<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;
    protected $fillable = ['number'];

    public function series(){
        return $this->belongsTo(Series::class);
    }

    //por ex: Season TEM MUITOS episode
    //              Deve ter o nome do relacionamento
    public function episodes(){
        //                Nome do model referente
        return $this->hasMany(Episode::class);
    }

    public function numberOfWatchedEpisodes() :int{
        return $this->episodes->filter(fn ($episode) => $episode->watched)->count();
    }

}
