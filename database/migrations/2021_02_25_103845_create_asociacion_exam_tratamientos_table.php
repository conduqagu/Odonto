<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsociacionExamTratamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asociacion_exam_tratamientos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('tratamiento_id');

            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
            $table->foreign('tratamiento_id')->references('id')->on('tratamientos');

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
        Schema::dropIfExists('asociacion_exam_tratamientos');
    }
}
