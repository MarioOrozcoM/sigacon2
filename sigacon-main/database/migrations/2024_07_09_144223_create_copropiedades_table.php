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
        Schema::create('copropiedades', function (Blueprint $table) {
            $table->id();
            $table->string('nit_copropiedad')->nullable();
            $table->string('nombre_copropiedad')->nullable();
            $table->enum('tipo_unidad', ['Apartamento', 'Casa', 'Local', 'Lote', 'Garaje', 'Bodega'])->nullable();
            $table->string('torre_bloque')->nullable();
            $table->string('n°')->nullable();
            $table->string('matricula_inmobiliaria')->nullable();
            $table->string('ficha_catastral')->nullable();
            $table->string('area_mt_cuadrado')->nullable();
            $table->string('coeficiente_participacion')->nullable();
            $table->string('propietario1')->nullable();
            $table->string('propietario2')->nullable();
            $table->string('inmobiliaria')->nullable();
            $table->string('arrendatario1')->nullable();
            $table->string('arrendatario2')->nullable();
            $table->string('placa_vehiculo')->nullable();
            $table->string('profesion_oficio')->nullable();
            //crear editar cuotas de administración
            $table->date('fecha_inicio_cuotaOrdinaria')->nullable();
            $table->date('fecha_final_cuotaOrdinaria')->nullable();
            $table->decimal('expensa_total_cuotaOrdinaria')->nullable();
            $table->decimal('incremento_expensas_mes_cuotaOrdinaria')->nullable();
            $table->string('modo_aplicacion_cuotaOrdinaria')->nullable();
            $table->date('fecha_inicio_ordinariaModular')->nullable();
            $table->date('fecha_final_ordinariaModular')->nullable();
            $table->decimal('expensa_total_ordinariaModular')->nullable();
            $table->decimal('incremento_expensas_mes_ordinariaModular')->nullable();
            $table->string('modo_aplicacion_ordinariaModular')->nullable();
            $table->date('fecha_inicio_extraordinaria')->nullable();
            $table->date('fecha_final_extraordinaria')->nullable();
            $table->decimal('expensa_total_extraordinaria')->nullable();
            $table->decimal('incremento_expensas_mes_extraordinaria')->nullable();
            $table->string('modo_aplicacion_extraordinaria')->nullable();
            $table->date('fecha_inicio_extraordinariaModular')->nullable();
            $table->date('fecha_final_extraordinariaModular')->nullable();
            $table->decimal('expensa_total_extraordinariaModular')->nullable();
            $table->decimal('incremento_expensas_mes_extraordinariaModular')->nullable();
            $table->string('modo_aplicacion_extraordinariaModular')->nullable();
            //Unidades
            $table->string('codigo_unidad1')->nullable();
            $table->string('nombre_unidad1')->nullable();
            $table->string('coeficiente_unidad1')->nullable();
            $table->string('cuotaOrdinaria_unidad1')->nullable();
            $table->string('ordinariaModular_unidad1')->nullable();
            $table->string('extraordinaria_unidad1')->nullable();
            $table->string('extraordinariaModular_unidad1')->nullable();
            //Crear editar descuento pronto pago
            $table->date('fechaInicio_descuentoOrdinaria')->nullable();
            $table->date('fecha_final_descuentoOrdinaria')->nullable();
            $table->string('descuento_porcentaje_ordinaria')->nullable();
            $table->string('valor_fijo_ordinaria')->nullable();
            $table->date('fechaInicio_descuentoOrdinariaModular')->nullable();
            $table->date('fecha_final_descuentoOrdinariaModular')->nullable();
            $table->string('descuento_porcentaje_ordinariaModular')->nullable();
            $table->string('valor_fijo_ordinariaModular')->nullable();
            //Crear editar retroactivos
            $table->date('fechaInicio_retroactivoOrdinaria')->nullable();
            $table->date('fechaFinal_retroactivoOrdinaria')->nullable();
            $table->string('nombreUnidad1_retroactivoOrdinaria')->nullable();
            $table->string('valorUnidad1_retroactivoOrdinaria')->nullable();
            $table->date('fechaInicio_retroactivoOrdinariaModular')->nullable();
            $table->date('fechaFinal_retroactivoOrdinariaModular')->nullable();
            $table->string('nombreUnidad1_retroactivoOrdinariaModular')->nullable();
            $table->string('valorUnidad1_retroactivoOrdinariaModular')->nullable();
            //Crear editar consejeros
            $table->date('fechaInicio_consejeroOrdinaria')->nullable();
            $table->date('fechaFinal_consejeroOrdinaria')->nullable();
            $table->string('descuentoOrdinaria_consejero')->nullable();
            $table->string('valorFijo_consejeroOrdinaria')->nullable();
            $table->string('nombreUnidad1_consejeroOrdinaria')->nullable();
            $table->string('propietarioUnidad1_consejeroOrdinaria')->nullable();
            $table->string('valorUnidad1_consejeroOrdinaria')->nullable();
            $table->date('fechaInicio_consejeroOrdinariaModular')->nullable();
            $table->date('fechaFinal_consejeroOrdinariaModular')->nullable();
            $table->string('descuentoOrdinariaModular_consejero')->nullable();
            $table->string('valorFijo_consejeroOrdinariaModular')->nullable();
            $table->string('valorUnidad1_consejeroOrdinariaModular')->nullable();
            //Crear editar conceptos de facturación
            $table->date('fechaInicio_conceptoFacturación')->nullable();
            $table->date('fechaFinal_conceptoFacturacion')->nullable();
            $table->string('codigo_conceptoFacturacion')->nullable();
            $table->enum('nombre_conceptoFacturacion', ['Todos los Conceptos', 'Cuota Ordinaria', 'Cuota Ordinaria Modular',
            'Cuota ExtraOrdinaria', 'Cuota ExtraOrdinaria Modular', 'Intereses de Mora', 'Arriendo', 'Multas y Sanciones',
            'Cuotas Especiales', 'Daños y Bienes', 'Uso zonas comunes', 'Descuento Pronto Pago', 'Descuento por consejero, cuota
            ordinaria y modular', 'Retroactivo cuota ordinaria', 'Retroactivo cuota ordinaria modular', 'Impuesto IVA generado'])->nullable();
            $table->string('valorFijo_conceptoFacturacion')->nullable();
            $table->string('valorImpuesto_IVAGeneradoPorcentaje')->nullable();
            $table->string('valorFijoImpuesto_IVAGenerado')->nullable();
            $table->string('imputacionContable_Db')->nullable();
            $table->string('imputacionContable_Cr')->nullable();
            //Crear editar intereses de mora
            $table->enum('aplicarA_conceptoFacturacion', ['Todos los conceptos', 'Periodo Aplicacion', 'Expensa total mes',
            'Incremento expensas mes %', 'Modo aplicación', 'Suma total', 'Cuotas expensas', 'Descuento pronto pago'])->nullable();
            $table->string('tasaMensual')->nullable();
            $table->string('logo')->nullable();
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
        Schema::dropIfExists('copropiedades');
    }
};
