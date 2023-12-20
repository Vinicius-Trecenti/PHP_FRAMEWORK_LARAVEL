<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;




class Series extends Model
{
    use HasFactory;
    protected $fillable = ['nome'];
    

    //O nome do metodo é o nome pelo qual queremos acessaar ele
    //temos em Serie uma função que chama as temporadas

    
    public function seasons(){
        //Estamos informando que o model Serie vai ter um relacionamento com 
        //o model temporadas(Season) do tipo um para muitos
        return $this->hasMany(Season::class, 'series_id');
        //                          informando que é para buscar por esse parametro
    }

    //criando um escopo de busca para o codigo
    protected static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('nome');
        });
    }
}
