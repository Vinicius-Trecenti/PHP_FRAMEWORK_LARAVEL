<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();

            $table->unsignedTinyInteger('number');

            // UM MODO DE ESCREVER
            // $table->unsignedBigIntegern('series_id');
            // //referenciando que a coluna series_id da tabela series é a chave estrangeira
            // //para o relacionamento
            // $table->foreign('series_id')->references('id')->on('series');

            //cria um campo series_id      faz o relacionamento com series_id e referencia com id da tabela que estamos relacionando
            $table->foreignId('series_id')->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seasons');
    }
};
