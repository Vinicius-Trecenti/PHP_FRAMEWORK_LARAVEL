<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
    protected $fillable = ['number'];

    //para dizer que nao vamos utilizar os timestamps
    public $timestamps = false;

    public function season(){
        return $this->belongsTo(Season::class);
    }
}
