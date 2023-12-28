<?php

use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\SeasonsController;

use App\Http\Controllers\teste;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [SeriesController::class, 'index']);

Route::get('/ola', function () {
    echo 'Ola Mundo, laravel';
});

Route::resource('/series', SeriesController::class)
    ->only(['index', 'create', 'store' ,'destroy', 'edit', 'update']
);

Route::get('/series/{series}/seasons', [SeasonsController::class, 'index'])->name('seasons.index');

Route::get('/season/{season}/episodes', [EpisodesController::class, 'index'])->name('episodes.index');
Route::post('/season/{season}/episodes', function (Illuminate\Http\Request $request){
    dd($request->all());
});
  
// Route::get('/series/edit/{id}', [SeriesController::class,'edit'])->name('series.edit');
// Route::post('/series/edit/{id}', [SeriesController::class, 'edit'])->name('series.edit');
// Route::post('/series/update/{id}', [SeriesController::class, 'update'])->name('series.update');

// Route::delete('/series/destroy/{serie}', [SeriesController::class,'destroy']) ->name('series.destroy');

// Route::post('/series/destroy/{serie}', [SeriesController::class, 'destroy'])->name('series.destroy');


// Route::controller(SeriesController::class)->group(function(){
//     //exibe as series
//     Route::get('/series', 'index')->name('series.index');

//     //pagina de criação
//     Route::get('series/create', 'create')->name('series.create');

//     //metodo para criar no banco e salvar
//     Route::post('series/salvar','store')->name('series.store');
// });

// Route::get('/series', [SeriesController::class, 'index']);

// Route::get('/teste', [teste::class, 'index']);
// Route::get('series/criar', [SeriesController::class,'create']);
// Route::post('series/salvar', [SeriesController::class,'store']);