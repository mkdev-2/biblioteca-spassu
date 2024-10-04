<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livro_assunto', function (Blueprint $table) {
            $table->id();  

            // Adicione as colunas antes de definir as chaves estrangeiras
            $table->unsignedBigInteger('Livro_CodLi');
            $table->unsignedBigInteger('Assunto_CodAs');

            // Definir as chaves estrangeiras
            $table->foreign('Livro_CodLi')->references('CodLi')->on('livros')->onDelete('cascade');
            $table->foreign('Assunto_CodAs')->references('CodAs')->on('assuntos')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livro_assunto');
    }
};
