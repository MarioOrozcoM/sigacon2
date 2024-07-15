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
        Schema::table('user', function (Blueprint $table) {
            // Eliminar la columna 'name'
            $table->dropColumn('name');
            
            // Agregar nuevas columnas
            $table->string('first_name')->nullable();
            $table->string('second_name')->nullable();
            $table->string('first_lastname')->nullable();
            $table->string('second_lastname')->nullable();
            $table->enum('document_type', ['Cedula de Ciudadania', 'Cedula de Extranjeria', 'Pasaporte', 'Tarjeta Identidad', 'Nit'])->nullable();
            $table->string('identification_number')->nullable();
            $table->string('social_reason')->nullable();
            $table->string('trade_name')->nullable();
            $table->string('physical_address')->nullable();
            $table->string('phone')->nullable();
            $table->string('cellphone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            // Revertir los cambios
            $table->string('name', 80);
            $table->dropColumn([
                'first_name',
                'second_name',
                'first_lastname',
                'second_lastname',
                'document_type',
                'identification_number',
                'social_reason',
                'trade_name',
                'physical_address',
                'phone',
                'cellphone',
                'active',
            ]);
        });
    }
};

