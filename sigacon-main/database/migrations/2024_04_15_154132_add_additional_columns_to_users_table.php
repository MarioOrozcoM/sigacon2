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
            // AutoRetenedor Renta
            $table->enum('autoretenedor_renta', ['Si', 'No'])->nullable();

            // AutoRetenedor Iva / Gran contribuyente
            $table->enum('autoretenedor_iva', ['Si', 'No'])->nullable();

            // AutoRetenedor Ica / Gran contribuyente
            $table->enum('autoretenedor_ica', ['Si', 'No'])->nullable();

            // Responsable Iva
            $table->enum('responsable_iva', ['Si', 'No'])->nullable();

            // Declarante RSTS
            $table->enum('declarante_rsts', ['Si', 'No'])->nullable();

            // Declarante Renta
            $table->enum('declarante_renta', ['Si', 'No'])->nullable();


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
            $table->dropColumn('autoretenedor_renta');
            $table->dropColumn('autoretenedor_iva');
            $table->dropColumn('autoretenedor_ica');
            $table->dropColumn('responsable_iva');
            $table->dropColumn('declarante_rsts');
            $table->dropColumn('declarante_renta');
        });
    }
};
