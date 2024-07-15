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
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('name', 80);
            $table->string('email', 50)->unique();
            $table->string('password', 255);
            $table->enum('rol', ['superUsuario', 'contador', 'administrador', 'repreLegal', 'juntaDirectiva', 'revisorFiscal', 'propietario', 'proveedor', 'cliente', 'inmobiliaria', 'normalUser'])->default('normalUser');
            $table->rememberToken();
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
        Schema::dropIfExists('user');
    }
};
