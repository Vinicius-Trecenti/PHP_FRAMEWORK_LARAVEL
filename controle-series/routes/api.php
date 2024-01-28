<?php

use App\Http\Controllers\Api\SeriesController;
use App\Models\Episode;
use App\Models\Series;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('series', [SeriesController::class, 'index']);
// Route::post('/series', [SeriesController::class, 'store']);


Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('/series', SeriesController::class);

    Route::get('/series/{series}/seasons', [SeriesController::class, 'getSeasons']);

    Route::get('/series/{series}/episodes', [SeriesController::class, 'getEpisodes']);

    Route::patch('/episodes/{episode}', function (Episode $episode, Request $request){
        $episode->watched = $request->watched;
        $episode->save();
        return $episode;
    });

    
}); 

Route::post('/login', function (Request $request){
    $credentials = $request->only(['email', 'password']);
    $user = User::whereEmail($credentials['email'])->first();

    // if($user == null || !Hash::check($credentials['password'], $user->password) == false){
    //     return response()->json('Não autorizado',401 );
    // }
    if(Auth::attempt($credentials) === false){
        return response()->json('Não autorizado',401 );
    }

    $user = Auth::user();
    $user->tokens()->delete();
    $token = $user->createToken('token', ['is_admin']);
    
    return response()->json($token->plainTextToken);
});
