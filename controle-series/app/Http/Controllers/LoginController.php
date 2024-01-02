<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index(){
        return view('login.index');
    }

    public function store(Request $request){
       //espera credencias e retorna verdadeiro ou falso
        if( !Auth::attempt($request->only(['email', 'password']))){
            return redirect()->back()->withErrors(['Usuário inválido ou senha incorreta!']);
        };

        return to_route('series.index');
    }
}
