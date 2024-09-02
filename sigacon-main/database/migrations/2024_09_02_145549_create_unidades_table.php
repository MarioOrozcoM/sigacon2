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
        Schema::create('unidades', function (Blueprint $table) {
            $table->id(); // Primary key, autoincrement
            $table->string('tipoUnidad'); // Tipo de unidad
            $table->string('torreBloque'); // Torre o bloque
            $table->string('number'); // Número de la unidad
            $table->string('matriculaInmobiliaria'); // Matrícula inmobiliaria
            $table->string('fichaCatastral'); // Ficha catastral
            $table->decimal('areaMt2'); // Área en metros cuadrados
            $table->string('propietario'); // Propietario
            $table->string('garaje'); // Garaje
            $table->decimal('porcentajeUnidad'); // Porcentaje de la unidad
            $table->decimal('totalCoeficiente'); // Total del coeficiente
            $table->foreignId('empresa_id')->constrained('empresas')->onDelete('cascade'); // Relación con la tabla de empresas
            $table->timestamps(); // Timestamps created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unidades');
    }
};
