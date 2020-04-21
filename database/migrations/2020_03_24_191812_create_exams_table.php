<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('date');
            $table->boolean('aspectoExtraoralNormal');
            $table->boolean('cancerOral');
            $table->boolean('anomaliasLabios');
            $table->string('otros')->nullable();
            $table->enum('patologiaMucosa',['Ninguna','Tumor maligno','leucoplasia','Liquen plano'])->nullable();
            $table->enum('fluorosis',['Normal','Discutible','Muy ligera','Ligera','Moderada','Intensa','Excluida','No registrada']);
            $table->enum('estadoS1',['sano','hemorragia','tártaro','bolsa 4-5 mm', 'Bolsa de 6 mm o más','excluido']);
            $table->enum('estadoS2',['sano','hemorragia','tártaro','bolsa 4-5 mm', 'Bolsa de 6 mm o más','excluido']);
            $table->enum('estadoS3',['sano','hemorragia','tártaro','bolsa 4-5 mm', 'Bolsa de 6 mm o más','excluido']);
            $table->enum('estadoS4',['sano','hemorragia','tártaro','bolsa 4-5 mm', 'Bolsa de 6 mm o más','excluido']);
            $table->enum('estadoS5',['sano','hemorragia','tártaro','bolsa 4-5 mm', 'Bolsa de 6 mm o más','excluido']);
            $table->enum('estadoS6',['sano','hemorragia','tártaro','bolsa 4-5 mm', 'Bolsa de 6 mm o más','excluido']);
            $table->enum('claseAngle', ['clase I', 'clase II', 'clase III']);
            $table->enum('lateralAngle', ['Unilateral', 'Bilateral']);
            $table->enum('tipoDentición', ['Temporal', 'Mixta']);
            $table->boolean('apiñamientoIncisivoInferior');
            $table->boolean('apiñamientoIncisivoSuperior');
            $table->boolean('perdidaEspacioAnterior');
            $table->boolean('perdidaEspacioPosterior');
            $table->boolean('mordidaCruzadaAnterior');
            $table->boolean('mordidaCruzadaPosterior');
            $table->boolean('desviacionLineaMedia');
            $table->boolean('mordidaAbierta');
            $table->boolean('habitos');
            $table->unsignedBigInteger('patient_id');

            $table->foreign('patient_id')->references('id')->on('patients');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
}
