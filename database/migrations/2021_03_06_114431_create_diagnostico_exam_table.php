<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosticoExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnostico_exam', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('comentario')->nullable();
            $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('diagnostico_id');

            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
            $table->foreign('diagnostico_id')->references('id')->on('diagnosticos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diagnostico_exam');
    }
}
