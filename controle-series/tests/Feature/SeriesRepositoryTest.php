<?php

namespace Tests\Feature;

use App\Http\Requests\SeriesFormRequest;
use App\Repositories\SeriesRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SeriesRepositoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
     public function teste_when_a_series_is_created_its_seasons_and_episodes_must_also_be_created(): void{
        //Arrange -> Preparar o cenario de teste
        $repository = $this->app->make(SeriesRepository::class);
        $request = new SeriesFormRequest();
        $request->nome = 'Teste de criação';
        $request->seasonsQty = 1;
        $request->episodesPerSeason = 1;

        //action
        $repository->add($request);

        //Assert -> Verifica se o resutaldo foi esperado
        $this->assertDatabaseHas('series', ['nome' => 'Teste de criação']);
        $this->assertDatabaseHas('seasons', ['number' => 1]);
        $this->assertDatabaseHas('episodes', ['number' => 1]);
     }
}
