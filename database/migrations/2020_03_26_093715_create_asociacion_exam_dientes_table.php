<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsociacionExamDientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asociacion_exam_dientes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('denticionRaiz', ['Sano','Cariado','Obturado sin caries','Obturado con caries',
                'Pérdida otro motivo', 'Fisura Obturada','Pilar puente/corona','Diente no erupcionado','Fractura'])->nullable();
            $table->enum('denticionCorona', ['Sano','Cariado','Obturado sin caries','Obturado con caries',
                'Pérdida otro motivo', 'Fisura Obturada','Pilar puente/corona','Diente no erupcionado','Fractura'])->nullable();
            $table->enum('tratamiento',['Ninguno','Preventivo','Obturación de fisuras','Obt. 1 o mas superficies',
                'Obt 2 o mas superficies','Corona','Carilla estética','Tratamiento pulgar','Exodoncia','No registrado'])->nullable();
            $table->enum('opacidad', ['Ningún estado anormal','Opacidad delimitada','OpacidadDifusa','Hipoplasia',
                'Otros defectos','Opacidad elimitada y difusa','Opacidad delimitada e hipoplasia','Opacidad difusa e hipoplasia',
                'Las tres alteraciones'])->nullable();
            $table->integer('furca')->nullable();
            $table->integer('rertraccion')->nullable();
            $table->integer('hipertrofia')->nullable();
            $table->integer('sondaje')->nullable();
            $table->boolean('movilidad')->nullable();
            $table->boolean('sangrado')->nullable();
            $table->boolean('encia_insertada')->nullable();
            $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('diente_id');

            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
            $table->foreign('diente_id')->references('id')->on('dientes');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asociacion_exam_dientes');
    }
}
