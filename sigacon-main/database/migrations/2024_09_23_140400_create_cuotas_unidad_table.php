<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuotasUnidadTable extends Migration
{
    public function up()
    {
        Schema::create('cuotas_unidad', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cuotas_ph_id')->constrained('cuotas_ph')->onDelete('cascade');
            $table->foreignId('unidad_id')->constrained('unidades')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cuotas_unidad');
    }
}
