<?php

namespace App\Http\Controllers;

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
            $cuotas = CuotaPH::whereHas('unidades', function ($query) use ($empresaId) {
                $query->where('empresa_id', $empresaId);
            })->get();
        }
        
        return view('facturacion.copropiedades.facturar', compact('empresas', 'cuotas'));
    }

    // Genera la factura en PDF
    public function generarFactura(Request $request)
    {
        $request->validate([
            'empresa_id' => 'required',
            'cuotas' => 'required|array',
        ]);

        $empresa = Empresa::findOrFail($request->input('empresa_id'));
        $cuotas = CuotaPH::whereIn('id', $request->input('cuotas'))->get();

        $facturaData = [
            'factura_id' => 'FS-' . now()->timestamp,
            'fecha_emision' => now()->format('d-M-Y'),
            'fecha_vencimiento' => now()->addDays(30)->format('d-M-Y'),
            'empresa' => $empresa,
            'cuotas' => $cuotas,
            'total' => $cuotas->sum('vrlIndividual'),
            'valor_en_letras' => $this->convertirNumeroALetras($cuotas->sum('vrlIndividual')),
            'cuenta_bancaria' => 'Davivienda APP N° 1663 6999 9676',
            'correo_pago' => 'contabilidad.sanjeronimo@gmail.com',
        ];

        $pdf = Pdf::loadView('facturacion.copropiedades.factura_pdf', compact('facturaData'));
        return $pdf->download('factura_' . $empresa->razon_social . '.pdf');
    }

    // Convierte el valor numérico a letras
    private function convertirNumeroALetras($numero)
    {
        return 'mil ' . number_format($numero, 2, ',', '.'); // Ejemplo básico
    }
}
