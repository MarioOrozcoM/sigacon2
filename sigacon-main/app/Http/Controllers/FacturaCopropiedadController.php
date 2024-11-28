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
            'tipo_descuento' => 'nullable|in:porcentaje,valor',
            'porcentaje_descuento' => 'nullable|numeric|min:0|max:100',
            'valor_descuento' => 'nullable|numeric|min:0',
        ]);
    
        // Obtener la empresa seleccionada junto con sus detalles
        $empresa = Empresa::with('detalle')->findOrFail($request->input('empresa_id'));
        $cuotas = CuotaPH::whereIn('id', $request->input('cuotas'))->get();
    
        // Verificar si la empresa tiene detalles
        $cuentaBancaria = $empresa->detalle->cuenta_banco ?? 'No disponible';
        $correoPago = $empresa->detalle->correo_factura ?? 'No disponible';
    
        // Obtener la fecha de vencimiento
        $fechaVencimiento = $cuotas->first()->hasta ?? 'No definida';
    
        // Calcular el descuento
        $total = $cuotas->sum('vrlIndividual');
        $tipoDescuento = $request->input('tipo_descuento', 'porcentaje'); // Por defecto, porcentaje
        $descuento = 0;
    
        if ($tipoDescuento === 'porcentaje') {
            $porcentajeDescuento = $request->input('porcentaje_descuento', 0);
            $descuento = $total * ($porcentajeDescuento / 100);
        } elseif ($tipoDescuento === 'valor') {
            $descuento = $request->input('valor_descuento', 0);
        }
    
        $totalConDescuento = max(0, $total - $descuento); // Evitar valores negativos
    
        $facturaData = [
            'factura_id' => 'FS-' . now()->timestamp,
            'fecha_emision' => now()->format('d-M-Y'),
            'fecha_vencimiento' => \Carbon\Carbon::parse($fechaVencimiento)->format('d-M-Y'),
            'empresa' => $empresa,
            'cuotas' => $cuotas,
            'total' => $total,
            'valor_en_letras' => $this->convertirNumeroALetras($totalConDescuento),
            'cuenta_bancaria' => $cuentaBancaria,
            'correo_pago' => $correoPago,
            'dias_pronto_pago' => $request->input('dias_pronto_pago'),
            'tipo_descuento' => $tipoDescuento,
            'porcentaje_descuento' => $request->input('porcentaje_descuento', 0),
            'valor_descuento' => $request->input('valor_descuento', 0),
            'descuento' => $descuento,
            'total_con_descuento' => $totalConDescuento,
            'detalle_cuotas' => $cuotas->map(function ($cuota) {
                $unidad = $cuota->unidades->first();
                return [
                    'aNombreDe' => $cuota->aNombreDe ?? 'N/A',
                    'observacion' => $cuota->observacion ?? 'N/A',
                    'tipoUnidad' => $unidad->tipoUnidad ?? 'Sin tipo',
                    'torreBloque' => $unidad->torreBloque ?? 'Sin torre/bloque',
                    'number' => $unidad->number ?? 'Sin número'
                ];
            })->all(),
            'logo' => $empresa->logo,
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

    public function generarFacturacionEnBloque(Request $request)
{
    $request->validate([
        'empresa_id' => 'required|integer|exists:empresas,id',
        'dias_pronto_pago' => 'nullable|integer|min:1',
        'tipo_descuento' => 'nullable|in:porcentaje,valor',
        'porcentaje_descuento' => 'nullable|numeric|min:0|max:100',
        'valor_descuento' => 'nullable|numeric|min:0',
    ]);

    $empresaId = $request->input('empresa_id');

    // Filtrar cuotas con concepto 'Cuota Administración' de la empresa seleccionada
    $cuotas = CuotaPH::with(['concepto', 'unidades', 'empresa'])
        ->whereHas('concepto', function ($query) {
            $query->where('nombreConcepto', 'Cuota Administración');
        })
        ->whereHas('unidades', function ($query) use ($empresaId) {
            $query->where('empresa_id', $empresaId);
        })
        ->get();

    // Obtener la razón social de la empresa para el nombre del archivo
    $empresa = Empresa::find($empresaId);
    $empresaName = $empresa ? $empresa->razon_social : 'empresa';

    // Inicializar un arreglo para guardar los PDFs generados
    $facturas = [];

    foreach ($cuotas as $cuota) {
        $unidad = $cuota->unidades->first();

        if (!$unidad || !$empresa) continue;

        $total = $cuota->vrlIndividual;
        $tipoDescuento = $request->input('tipo_descuento', 'porcentaje');
        $descuento = 0;

        if ($tipoDescuento === 'porcentaje') {
            $porcentajeDescuento = $request->input('porcentaje_descuento', 0);
            $descuento = $total * ($porcentajeDescuento / 100);
        } elseif ($tipoDescuento === 'valor') {
            $descuento = $request->input('valor_descuento', 0);
        }

        $totalConDescuento = max(0, $total - $descuento);

        $facturaData = [
            'factura_id' => 'FS-' . now()->timestamp . '-' . $cuota->id,
            'fecha_emision' => now()->format('d-M-Y'),
            'fecha_vencimiento' => $cuota->hasta ?? now()->addDays(30)->format('d-M-Y'),
            'empresa' => $empresa,
            'cuotas' => [$cuota],
            'total' => $total,
            'valor_en_letras' => $this->convertirNumeroALetras($totalConDescuento),
            'cuenta_bancaria' => $empresa->detalle->cuenta_banco ?? 'No disponible',
            'correo_pago' => $empresa->detalle->correo_factura ?? 'No disponible',
            'dias_pronto_pago' => $request->input('dias_pronto_pago'),
            'tipo_descuento' => $tipoDescuento,
            'porcentaje_descuento' => $request->input('porcentaje_descuento', 0),
            'valor_descuento' => $request->input('valor_descuento', 0),
            'descuento' => $descuento,
            'total_con_descuento' => $totalConDescuento,
            'detalle_cuotas' => [
                [
                    'aNombreDe' => $cuota->aNombreDe ?? 'N/A',
                    'observacion' => $cuota->observacion ?? 'N/A',
                    'tipoUnidad' => $unidad->tipoUnidad ?? 'Sin tipo',
                    'torreBloque' => $unidad->torreBloque ?? 'Sin torre/bloque',
                    'number' => $unidad->number ?? 'Sin número'
                ]
            ],
            'logo' => $empresa->logo,
        ];

        $pdf = Pdf::loadView('facturacion.copropiedades.factura_pdf', compact('facturaData'));

        $nombreArchivo = "factura_{$unidad->tipoUnidad}_{$unidad->number}.pdf";

        $facturas[] = [
            'pdf' => $pdf->output(),
            'nombre' => $nombreArchivo,
        ];
    }

    // Devolver las facturas como un archivo comprimido ZIP
    $zipFileName = 'facturas_bloque_' . str_replace(' ', '_', $empresaName) . '.zip';
    $zipFile = storage_path('app/public/' . $zipFileName);
    $zip = new \ZipArchive();
    if ($zip->open($zipFile, \ZipArchive::CREATE | \ZipArchive::OVERWRITE)) {
        foreach ($facturas as $factura) {
            $zip->addFromString($factura['nombre'], $factura['pdf']);
        }
        $zip->close();
    }

    return response()->download($zipFile)->deleteFileAfterSend();
}

    
    
    

    public function configurarFacturacionEnBloque($empresa_id = null)
    {
        $empresa = $empresa_id ? Empresa::find($empresa_id) : null;
    
        // Si se ha seleccionado una empresa, contar las cuotas de "Cuota Administración" asociadas
        $totalFacturas = 0;
        if ($empresa) {
            $totalFacturas = CuotaPH::whereHas('concepto', function ($query) {
                $query->where('nombreConcepto', 'Cuota Administración');
            })
            ->whereHas('unidades', function ($query) use ($empresa_id) {
                $query->where('empresa_id', $empresa_id);
            })
            ->count(); // Contar el total de cuotas de administración
        }
    
        // Pasar la empresa y el número total de facturas a la vista
        return view('facturacion.copropiedades.factura_bloque', compact('empresa', 'totalFacturas'));
    }
    

}