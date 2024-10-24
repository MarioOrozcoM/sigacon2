<?php

namespace App\Http\Controllers;

use App\Models\CuotaPH;
use App\Models\Empresa;
use Illuminate\Http\Request;
use PDF;

class FacturaCopropiedadController extends Controller
{
    // Mostrar empresas y cuotas asignadas para seleccionar
    public function seleccionarEmpresa(Request $request)
    {
        // Obtener todas las empresas del tipo Propiedad Horizontal
        $empresas = Empresa::where('tipo_empresa', 'Propiedad Horizontal')->get();

        // Obtener la empresa seleccionada
        $empresaId = $request->input('empresa_id');

        // Obtener las cuotas asignadas a la empresa seleccionada
        $cuotas = [];
        if ($empresaId) {
            $cuotas = CuotaPH::where('empresa_id', $empresaId)->get();
        }

        return view('facturar', compact('empresas', 'cuotas'));
    }

    // Generar factura en PDF
    public function generarFactura(Request $request)
    {
        // Validar que se seleccionen cuotas
        $request->validate([
            'cuotas' => 'required|array',
        ]);

        // Obtener las cuotas seleccionadas
        $cuotas = CuotaPH::whereIn('id', $request->input('cuotas'))->get();

        // Obtener la información de la empresa seleccionada
        $empresa = Empresa::findOrFail($request->input('empresa_id'));

        // Preparar los datos para el PDF
        $facturaData = [
            'factura_id' => 'FS-' . time(),
            'fecha_emision' => now()->format('d-M-Y'),
            'fecha_vencimiento' => now()->addDays(30)->format('d-M-Y'),
            'empresa' => $empresa->razon_social,
            'cuotas' => $cuotas,
            'total' => $cuotas->sum('vrlIndividual'),
            'valor_en_letras' => $this->convertirNumeroALetras($cuotas->sum('vrlIndividual')),
            'cuenta_bancaria' => 'Davivienda APP N° 1663 6999 9676',
            'correo_pago' => 'contabilidad.sanjeronimo@gmail.com',
        ];

        // Generar el PDF utilizando la vista 'factura_pdf'
        $pdf = PDF::loadView('factura_pdf', compact('facturaData'));

        return $pdf->download('factura_' . $empresa->razon_social . '.pdf');
    }

    // Método auxiliar para convertir el número en letras (puedes implementar según tu lógica)
    private function convertirNumeroALetras($numero)
    {
        // Aquí puedes implementar la lógica para convertir un número a letras
        // Esta función debe retornar el valor del número en palabras, por ejemplo: "mil doscientos pesos"
        return 'mil ' . number_format($numero, 2, ',', '.');
    }
}