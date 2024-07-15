<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ExcelController extends Controller
{
    public function downloadExcel($userId)
    {
        // Obtener el usuario específico según el ID proporcionado
        $user = User::findOrFail($userId);

        // Crear una instancia de PhpSpreadsheet y generar el archivo Excel con los datos del usuario
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Agregar encabezados de columna
        $sheet->setCellValue('A1', 'Documento Identificación');
        $sheet->setCellValue('B1', 'Número Documento Identificación');
        $sheet->setCellValue('C1', 'Primer Nombre');
        $sheet->setCellValue('D1', 'Segundo Nombre');
        $sheet->setCellValue('E1', 'Primer Apellido');
        $sheet->setCellValue('F1', 'Segundo Apellido');
        $sheet->setCellValue('G1', 'Rol');
        $sheet->setCellValue('H1', 'Razón Social');
        $sheet->setCellValue('I1', 'Nombre Comercial');
        $sheet->setCellValue('J1', 'Dirección Física');
        $sheet->setCellValue('K1', 'Email');
        $sheet->setCellValue('L1', 'Teléfono');
        $sheet->setCellValue('M1', 'Celular');
        $sheet->setCellValue('N1', 'País');
        $sheet->setCellValue('O1', 'Estado/Departamento');
        $sheet->setCellValue('P1', 'Ciudad');
        $sheet->setCellValue('Q1', 'Autoretenedor Renta');
        $sheet->setCellValue('R1', 'Autoretenedor Iva');
        $sheet->setCellValue('S1', 'Autoretenedor ICA');
        $sheet->setCellValue('T1', 'Responsable de IVA');
        $sheet->setCellValue('U1', 'Declarante de RSTS');
        $sheet->setCellValue('V1', 'Declarante de Renta');
        // Agregar más encabezados según sea necesario...

                // Obtener los nombres del país, estado y ciudad del usuario
                $countryName = $user->country->name;
                $stateName = $user->state->name;
                $cityName = $user->city->name;

        // Agregar datos del usuario al archivo Excel
        $sheet->setCellValue('A2', $user->document_type);
        $sheet->setCellValue('B2', $user->identification_number);
        $sheet->setCellValue('C2', $user->first_name);
        $sheet->setCellValue('D2', $user->second_name);
        $sheet->setCellValue('E2', $user->first_lastname);
        $sheet->setCellValue('F2', $user->second_lastname);
        $sheet->setCellValue('G2', $user->rol);
        $sheet->setCellValue('H2', $user->social_reason);
        $sheet->setCellValue('I2', $user->trade_name);
        $sheet->setCellValue('J2', $user->physical_address);
        $sheet->setCellValue('K2', $user->email);
        $sheet->setCellValue('L2', $user->phone);
        $sheet->setCellValue('M2', $user->cellphone);
        $sheet->setCellValue('N2', $countryName);
        $sheet->setCellValue('O2', $stateName);
        $sheet->setCellValue('P2', $cityName);
        $sheet->setCellValue('Q2', $user->autoretenedor_renta);
        $sheet->setCellValue('R2', $user->autoretenedor_iva);
        $sheet->setCellValue('S2', $user->autoretenedor_ica);
        $sheet->setCellValue('T2', $user->responsable_iva);
        $sheet->setCellValue('U2', $user->declarante_rsts);
        $sheet->setCellValue('V2', $user->declarante_renta);
        // Agregar más datos según sea necesario...

        // Ajustar el ancho de las columnas automáticamente según el contenido
        foreach (range('A', 'V') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }


        // Generar el archivo Excel y guardarlo
        $writer = new Xlsx($spreadsheet);
        $filename = 'user_data.xlsx';
        $writer->save($filename);

        // Descargar el archivo Excel generado
        return response()->download($filename)->deleteFileAfterSend(true);
    }
}
