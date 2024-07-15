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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_empresa')->nullable();
            $table->enum('tipo_empresa', ['Comercial', 'Servicios', 'Propiedad Horizontal', 'Asociacion', 'Salud', 'Industrial', 'Fundacion'])->nullable();
            $table->string('numero_identificacion')->nullable();
            $table->boolean('persona_juridica')->default(false);
            $table->string('primer_nombre')->nullable();
            $table->string('segundo_nombre')->nullable();
            $table->string('primer_apellido')->nullable();
            $table->string('segundo_apellido')->nullable();
            $table->string('razon_social')->nullable();
            $table->string('nombre_comercial')->nullable();
            $table->string('numero_identificacion_repre')->nullable();
            $table->date('fecha_inicio_repre')->nullable();
            $table->string('numero_acta_repre')->nullable();
            $table->string('numero_identificacion_suplente')->nullable();
            $table->date('fecha_inicio_suplente')->nullable();
            $table->string('numero_acta_suplente')->nullable();
            $table->string('numero_identificacion_contador')->nullable();
            $table->date('fecha_inicio_contador')->nullable();
            $table->string('tarjeta_profesional_contador')->nullable();
            $table->string('numero_identificacion_revisor')->nullable();
            $table->date('fecha_inicio_revisor')->nullable();
            $table->string('tarjeta_profesional_revisor')->nullable();
            $table->string('numero_acta_revisor')->nullable();
            $table->string('numero_identificacion_socio')->nullable();
            $table->date('fecha_registro_socio')->nullable();
            $table->integer('numero_acciones')->nullable();
            $table->string('numero_titulo')->nullable();
            $table->string('numero_resolucion')->nullable();
            $table->date('fecha_resolucion')->nullable();
            $table->string('rangos_numeracion')->nullable();
            $table->text('observaciones')->nullable();
            $table->string('logo')->nullable();
            $table->enum('tamano_empresa', ['Grande', 'Mediana', 'Pequeña', 'Micro'])->nullable();
            $table->boolean('active')->default(true); // Aquí agregamos la columna 'active'
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
        Schema::dropIfExists('empresas');
    }
};
