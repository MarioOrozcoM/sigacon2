<?php

namespace App\Exports;

use App\Models\CuotaPH;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet; // Asegúrate de incluir esta línea
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Font;

class CuotaPHExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithEvents
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
                        'vrlIndividual' => (float) str_replace('.', '', $cuota->vrlIndividual),
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
            'A Nombre de',
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

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Proteger la hoja
                $sheet->getProtection()->setSheet(true); // Activa la protección de la hoja
                $sheet->getProtection()->setPassword('your_password'); // Establece una contraseña si deseas

                // Establecer la protección para las celdas
                // Bloquear Cuota ID y Concepto
                $sheet->getStyle('A2:B' . $sheet->getHighestRow())->getProtection()->setLocked(true); 
                // Bloquear Tipo
                $sheet->getStyle('D2:D' . $sheet->getHighestRow())->getProtection()->setLocked(true); 
                // Bloquear Empresa
                $sheet->getStyle('H2:H' . $sheet->getHighestRow())->getProtection()->setLocked(true); 
                // Bloquear Tipo de Unidad
                $sheet->getStyle('I2:I' . $sheet->getHighestRow())->getProtection()->setLocked(true); 
                // Bloquear Número de Unidad
                $sheet->getStyle('J2:J' . $sheet->getHighestRow())->getProtection()->setLocked(true); 

                // Desbloquear celdas específicas (por ejemplo, valor individual, A nombre de, desde, hasta y observación)
                $sheet->getStyle('C2:C' . $sheet->getHighestRow())->getProtection()->setLocked(false); // Valor Individual
                $sheet->getStyle('E2:E' . $sheet->getHighestRow())->getProtection()->setLocked(false); // A Nombre de
                $sheet->getStyle('F2:F' . $sheet->getHighestRow())->getProtection()->setLocked(false); // Desde
                $sheet->getStyle('G2:G' . $sheet->getHighestRow())->getProtection()->setLocked(false); // Hasta
                $sheet->getStyle('K2:K' . $sheet->getHighestRow())->getProtection()->setLocked(false); // Observacion
            },
        ];
    }
}
