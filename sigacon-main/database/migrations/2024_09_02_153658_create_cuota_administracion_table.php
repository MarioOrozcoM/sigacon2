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
        Schema::create('cuota_administracion', function (Blueprint $table) {
            $table->id(); // Primary key, autoincrement
            $table->decimal('cuotaMensual1'); // Cuota Mensual 1
            $table->decimal('cuotaMensual1SinDescuento'); // Cuota Mensual 1 sin descuento
            $table->decimal('descuento'); // Descuento
            $table->decimal('cuotaMensual2Descuento'); // Cuota Mensual 2 con descuento
            $table->decimal('diferenciaMensualIncremento'); // Diferencia mensual incremento
            $table->decimal('valorRetroactivo'); // Valor retroactivo
            $table->decimal('totalPagarSinDescuento'); // Total a pagar sin descuento
            $table->foreignId('unidad_id')->constrained('unidades')->onDelete('cascade'); // Foreign key hacia unidades
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuota_administracion');
    }
};
