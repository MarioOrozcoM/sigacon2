<?php

namespace App\Exports;

use App\Models\CuotaPH;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Font;

class CuotaPHExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $empresaId;

    public function __construct($empresaId)
    {
        $this->empresaId = $empresaId;
    }

    public function collection()
    {
        $data = [];
        $cuotas = CuotaPH::with(['unidades', 'empresa', 'concepto'])
            ->whereHas('unidades', function ($query) {
                $query->where('empresa_id', $this->empresaId);
            })
            ->get();

        foreach ($cuotas as $cuota) {
            foreach ($cuota->unidades as $unidad) {
                if ($unidad->empresa_id == $this->empresaId) {
                    $data[] = [
                        'cuota_id' => $cuota->id,
                        'concepto' => $cuota->concepto->nombreConcepto,
                        'vrlIndividual' => number_format($cuota->vrlIndividual, 3, ',', '.'),
                        'tipo' => $cuota->tipo,
                        'aNombreDe' => $cuota->aNombreDe,
                        'desde' => $cuota->desde,
                        'hasta' => $cuota->hasta,
                        'empresa' => $unidad->empresa->razon_social,
                        'unidad_tipo' => $unidad->tipoUnidad,
                        'unidad_number' => $unidad->number,
                        'observacion' => $cuota->observacion
                    ];
                }
            }
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'Cuota ID',
            'Concepto',
            'Valor Individual',
            'Tipo',
            'Nombre de',
            'Desde',
            'Hasta',
            'Empresa',
            'Tipo de Unidad',
            'Número de Unidad',
            'Observacion'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Establece el estilo para los encabezados (negrita)
        $sheet->getStyle('A1:K1')->getFont()->setBold(true);
    }
}
