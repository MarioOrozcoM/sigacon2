<?php

namespace App\Exports;

use App\Models\Unidad;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UnidadExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $empresaId;

    public function __construct($empresaId)
    {
        $this->empresaId = $empresaId;
    }

    public function collection()
    {
        $data = [];
        // Obtener las unidades relacionadas con la empresa especificada
        $unidades = Unidad::with('empresa')
            ->where('empresa_id', $this->empresaId) // Filtrar por empresa
            ->get();

        // Crear el arreglo de datos para cada unidad
        foreach ($unidades as $unidad) {
            $data[] = [
                'unidad_id' => $unidad->id,
                'unidad_tipo' => $unidad->tipoUnidad,
                'torre_bloque' => $unidad->torreBloque,
                'unidad_number' => $unidad->number,
                'matriculaInmobiliaria' => $unidad->matriculaInmobiliaria,
                'fichaCatastral' => $unidad->fichaCatastral,
                'areaMt2' => $unidad->areaMt2,
                'propietario' => $unidad->propietario,
                'empresa' => $unidad->empresa->razon_social ?? 'N/A',
                'garaje' => $unidad->garaje,
                'porcentajeUnidad' => $unidad->porcentajeUnidad,
                'totalCoeficiente' => $unidad->totalCoeficiente
            ];
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'Unidad ID',
            'Tipo de Unidad',
            'Torre o Bloque',
            'Número de Unidad',
            'Matrícula Inmobiliaria',
            'Ficha Catastral',
            'Área Mt2',
            'Propietario',
            'Empresa',
            'Garaje',
            'Porcentaje de la Unidad',
            'Total Coeficiente'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Establecer estilo para los encabezados
        $sheet->getStyle('A1:L1')->getFont()->setBold(true);
    }
}
