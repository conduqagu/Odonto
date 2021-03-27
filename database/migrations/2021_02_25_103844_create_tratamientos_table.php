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
            $table->double('coste');
            $table->double('iva');
            $table->boolean('cobrado');
            $table->enum('terapia',['sin definir','convencional','fases']);
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->unsignedBigInteger('braket_id');
            $table->foreign('braket_id')->references('id')->on('brakets')->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('tipo_tratamiento_id');
            $table->foreign('tipo_tratamiento_id')->references('id')->on('tipo_tratamientos')->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('exam_id');
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade')->nullable();


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
