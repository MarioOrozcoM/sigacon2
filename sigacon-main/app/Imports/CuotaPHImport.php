<?php

namespace App\Imports;

use App\Models\CuotaPH;
use App\Models\Unidad;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CuotaPHImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $unidad = Unidad::where('tipoUnidad', $row['unidad_tipo'])
                        ->where('number', $row['unidad_number'])
                        ->first();

        return new CuotaPH([
            'concepto_id' => $row['concepto_id'],
            'vrlIndividual' => $row['vrl_individual'],
            'tipo' => $row['tipo'],
            'aNombreDe' => $row['a_nombre_de'],
            'desde' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['desde']),
            'hasta' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['hasta']),
            'empresa_id' => $row['empresa_id'], // Suponiendo que estás pasando el ID de la empresa
            'unidad_id' => $unidad ? $unidad->id : null,
        ]);
    }
}
