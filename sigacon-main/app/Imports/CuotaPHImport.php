<?php

namespace App\Imports;

use App\Models\CuotaPH;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Collection;

class CuotaPHImport implements ToModel, WithHeadingRow, WithValidation, WithBatchInserts, WithChunkReading
{
    protected $empresaId;

    public function __construct($empresaId)
    {
        $this->empresaId = $empresaId;
    }

    public function model(array $row)
    {
        // Aquí puedes agregar la lógica para crear o actualizar el modelo CuotaPH
        // Basado en el contenido del archivo importado.

        return new CuotaPH([
            'concepto_id' => $row['concepto_id'], // Asegúrate de que la clave sea correcta según el encabezado
            'vrlIndividual' => str_replace(',', '.', $row['valor_individual']), // Convierte el valor si es necesario
            'tipo' => $row['tipo'],
            'aNombreDe' => $row['a_nombre_de'],
            'desde' => \Carbon\Carbon::createFromFormat('d/m/Y', $row['desde']), // Asegúrate del formato de fecha
            'hasta' => \Carbon\Carbon::createFromFormat('d/m/Y', $row['hasta']), // Asegúrate del formato de fecha
            'empresa_id' => $this->empresaId, // Usamos el ID de la empresa que fue pasado
            'observacion' => $row['observacion']
        ]);
    }

    public function rules(): array
    {
        return [
            'concepto_id' => 'required|exists:conceptos,id', // Valida que el concepto exista
            'valor_individual' => 'required|numeric',
            'tipo' => 'required|string',
            'a_nombre_de' => 'required|string',
            'desde' => 'required|date_format:d/m/Y',
            'hasta' => 'required|date_format:d/m/Y',
            'observacion' => 'nullable|string',
        ];
    }

    public function batchSize(): int
    {
        return 1000; // Ajusta el tamaño del lote según tus necesidades
    }

    public function chunkSize(): int
    {
        return 1000; // Ajusta el tamaño del chunk según tus necesidades
    }
}