<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuotasPHTable extends Migration
{
    public function up()
    {
        Schema::create('cuotas_ph', function (Blueprint $table) {
            $table->id();
            $table->string('vrlIndividual');
            $table->enum('tipo', ['Constante', 'Novedad']);
            $table->string('aNombreDe');
            $table->date('desde');
            $table->date('hasta')->nullable();
            $table->text('observacion')->nullable();
            $table->foreignId('concepto_id')->constrained('conceptos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cuotas_ph');
    }
}
