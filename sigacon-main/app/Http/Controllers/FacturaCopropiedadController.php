<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use App\Models\CuotaPH;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class FacturaCopropiedadController extends Controller
{
    // Muestra empresas y cuotas para seleccionar
    public function seleccionarEmpresa(Request $request)
    {
        $empresas = Empresa::where('tipo_empresa', 'Propiedad Horizontal')->get();
        $empresaId = $request->input('empresa_id');
        
        $cuotas = [];
        if ($empresaId) {
            // Filtrar cuotas por las unidades de la empresa seleccionada
            $cuotas = CuotaPH::with(['concepto', 'unidades' => function ($query) use ($empresaId) {
                    $query->where('empresa_id', $empresaId);
                }])
                ->whereHas('unidades', function ($query) use ($empresaId) {
                    $query->where('empresa_id', $empresaId);
                })
                ->get();
        }
        
        return view('facturacion.copropiedades.facturar', compact('empresas', 'cuotas'));
    }

    // Genera la factura en PDF
    public function generarFactura(Request $request)
    {
        $request->validate([
            'empresa_id' => 'required',
            'cuotas' => 'required|array',
            'dias_pronto_pago' => 'nullable|integer|min:1',
            'porcentaje_descuento' => 'nullable|numeric|min:0|max:100',
        ]);
    
        // Obtener la empresa seleccionada junto con sus detalles
        $empresa = Empresa::with('detalle')->findOrFail($request->input('empresa_id'));
        $cuotas = CuotaPH::whereIn('id', $request->input('cuotas'))->get();
    
        // Verificar si la empresa tiene detalles
        $cuentaBancaria = $empresa->detalle->cuenta_banco ?? 'No disponible'; // Valor predeterminado si no existe
        $correoPago = $empresa->detalle->correo_factura ?? 'No disponible'; // Valor predeterminado si no existe
    
        // Obtener la fecha de vencimiento desde la base de datos (columna "hasta")
        $fechaVencimiento = $cuotas->first()->hasta ?? 'No definida'; // Valor predeterminado si no existe
    
        // Calcular el descuento por pronto pago
        $total = $cuotas->sum('vrlIndividual');
        $descuento = $total * ($request->input('porcentaje_descuento') / 100);
        $totalConDescuento = $total - $descuento;
    
        $facturaData = [
            'factura_id' => 'FS-' . now()->timestamp,
            'fecha_emision' => now()->format('d-M-Y'),
            'fecha_vencimiento' => \Carbon\Carbon::parse($fechaVencimiento)->format('d-M-Y'),
            'empresa' => $empresa,
            'cuotas' => $cuotas,
            'total' => $total,
            'valor_en_letras' => $this->convertirNumeroALetras($total),
            'cuenta_bancaria' => $cuentaBancaria,
            'correo_pago' => $correoPago,
            'dias_pronto_pago' => $request->input('dias_pronto_pago'),
            'porcentaje_descuento' => $request->input('porcentaje_descuento'),
            'descuento' => $descuento,
            'total_con_descuento' => $totalConDescuento,
            'detalle_cuotas' => $cuotas->map(function ($cuota) {
                $unidad = $cuota->unidades->first(); // Obtenemos la primera unidad asociada si existe
                return [
                    'aNombreDe' => $cuota->aNombreDe ?? 'N/A',
                    'observacion' => $cuota->observacion ?? 'N/A',
                    'tipoUnidad' => $unidad->tipoUnidad ?? 'Sin tipo',
                    'torreBloque' => $unidad->torreBloque ?? 'Sin torre/bloque',
                    'number' => $unidad->number ?? 'Sin número'
                ];
            })->all(), // Convierte la colección a un array
            'logo' => $empresa->logo, // Agregamos el logo de la empresa 
        ];

        // Ajustar tamaño de la hoja dependiendo del contenido
        $altura = 841.89 + (count($facturaData['cuotas']) - 10) * 20;
        $pdf = Pdf::loadView('facturacion.copropiedades.factura_pdf', compact('facturaData', 'empresa'));
        $pdf->setPaper([0, 0, 595.28, $altura]);

        return $pdf->download('factura_' . $empresa->razon_social . '.pdf');
    }

    // Convierte el valor numérico a letras
    private function convertirNumeroALetras($numero)
    {
        $numero = str_replace('.', '', $numero);
        $numero = intval($numero); // Convertir a entero
        
        $formatter = new \NumberFormatter('es', \NumberFormatter::SPELLOUT);
        return strtoupper($formatter->format($numero)) . ' MIL PESOS mcte.';
    }
}