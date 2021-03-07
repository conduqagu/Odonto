<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTratamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tratamientos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->boolean('realizado');
            $table->double('coste');
            $table->double('iva');
            $table->boolean('cobrado');
            $table->enum('terapia',['sin definir','convencional','fases']);
            //TODO: Determinar tipo de duración estimada
            $table->string('duraciónEstimada')->nullable();
            $table->unsignedBigInteger('brakets_id');
            $table->foreign('brakets_id')->references('id')->on('brakets')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tratamientos');
    }
}
