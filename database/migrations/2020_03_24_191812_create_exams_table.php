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
            $table->integer('iva');
            $table->integer('costeTotal');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->unsignedBigInteger('patient_id');
            $table->enum('tipoExam',['inicial','evaluacion']);


            //Atributos Examen inicial
            $table->boolean('aspectoExtraoralNormal')->nullable();
            $table->boolean('cancerOral')->nullable();
            $table->boolean('anomaliasLabios')->nullable();
            $table->enum('patologiaMucosa',['Ninguna','Tumor maligno','leucoplasia','Liquen plano'])->nullable();
            $table->enum('fluorosis',['Normal','Discutible','Muy ligera','Ligera','Moderada','Intensa','Excluida','No registrada'])->nullable();
            $table->enum('estadoS1',['sano','hemorragia','tártaro','bolsa 4-5 mm', 'Bolsa de 6 mm o más','excluido'])->nullable();
            $table->enum('estadoS2',['sano','hemorragia','tártaro','bolsa 4-5 mm', 'Bolsa de 6 mm o más','excluido'])->nullable();
            $table->enum('estadoS3',['sano','hemorragia','tártaro','bolsa 4-5 mm', 'Bolsa de 6 mm o más','excluido'])->nullable();
            $table->enum('estadoS4',['sano','hemorragia','tártaro','bolsa 4-5 mm', 'Bolsa de 6 mm o más','excluido'])->nullable();
            $table->enum('estadoS5',['sano','hemorragia','tártaro','bolsa 4-5 mm', 'Bolsa de 6 mm o más','excluido'])->nullable();
            $table->enum('estadoS6',['sano','hemorragia','tártaro','bolsa 4-5 mm', 'Bolsa de 6 mm o más','excluido'])->nullable();
            $table->enum('claseAngle', ['clase I', 'clase II', 'clase III'])->nullable();
            $table->enum('lateralAngle', ['Unilateral', 'Bilateral'])->nullable();
            $table->enum('tipoDentición', ['Temporal', 'Mixta'])->nullable();
            $table->boolean('apiñamientoIncisivoInferior')->nullable();
            $table->boolean('apiñamientoIncisivoSuperior')->nullable();
            $table->boolean('perdidaEspacioAnterior')->nullable();
            $table->boolean('perdidaEspacioPosterior')->nullable();
            $table->boolean('mordidaCruzadaAnterior')->nullable();
            $table->boolean('mordidaCruzadaPosterior')->nullable();
            $table->boolean('desviacionLineaMedia')->nullable();
            $table->boolean('mordidaAbierta')->nullable();
            $table->boolean('habitos')->nullable();

            //Atributos periodoncia
            $table->double('indicePlaca')->nullable();
            $table->enum('color',['rosa','rojo'])->nullable();
            $table->enum('borde',['afilado','engrosado'])->nullable();
            $table->enum('aspecto',['puntillado','liso'])->nullable();
            $table->enum('consistencia',['firme','depresible'])->nullable();
            $table->integer('biotipo')->nullable();

            //Atributos Ortodoncia
            $table->enum('patronFacial',['dolicofacial','mesofacial','braquifacial'])->nullable();
            $table->enum('perfil',['armonico','convexo','concavo','plano'])->nullable();
            $table->enum('menton',['marcado','normal','retruido','plano'])->nullable();
            //TODO: Crear tabla con tipo de terapia
            $table->integer('tipoTerapia')->nullable();
            //TODO: Determinar tipo de duración estimada
            $table->string('duraciónEstimada')->nullable();
            $table->string('otros')->nullable();

            //Atributos Evaluacion
            $table->string('previsto')->nullable();
            $table->string('maxilar')->nullable();
            $table->string('mandibular')->nullable();
            $table->string('logrado')->nullable();

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
