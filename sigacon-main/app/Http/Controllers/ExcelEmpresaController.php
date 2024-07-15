<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ExcelEmpresaController extends Controller
{
    public function downloadExcelEmpresa($empresaId){
        // Obtener la empresa específica según el ID proporcionado
        $empresa = Empresa::findOrFail($empresaId);

        // Crear una instancia de PhpSpreadsheet y generar el archivo Excel con los datos de la empresa
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        //Encabezados de columna
        $sheet->setCellValue('A1', 'Código Empresa');
        $sheet->setCellValue('B1', 'Tipo de Empresa');
        $sheet->setCellValue('C1', 'Número de Identificación');
        $sheet->setCellValue('D1', 'Persona Jurídica');
        $sheet->setCellValue('E1', 'Primer Nombre');
        $sheet->setCellValue('F1', 'Segundo Nombre');
        $sheet->setCellValue('G1', 'Primer Apellido');
        $sheet->setCellValue('H1', 'Segundo Apellido');
        $sheet->setCellValue('I1', 'Razón Social');
        $sheet->setCellValue('J1', 'Nombre Comercial');
        $sheet->setCellValue('K1', 'Número identificación Representante Legal');
        $sheet->setCellValue('L1', 'Fecha Inicio Representante Legal');
        $sheet->setCellValue('M1', 'Número Acta Representante Legal');
        $sheet->setCellValue('N1', 'Número identificación Representante Legal Suplente');
        $sheet->setCellValue('O1', 'Fecha Inicio Representante Legal Suplente');
        $sheet->setCellValue('P1', 'Número Acta Representante Legal Suplente');
        $sheet->setCellValue('Q1', 'Número Identificación Contador');
        $sheet->setCellValue('R1', 'Fecha Inicio Contador');
        $sheet->setCellValue('S1', 'Tarjeta Profesional Contador');

        $sheet->setCellValue('A4', 'Número Identificación Revisor');
        $sheet->setCellValue('B4', 'Fecha Inicio Revisor');
        $sheet->setCellValue('C4', 'Tarjeta Profesional Revisor');
        $sheet->setCellValue('D4', 'Número Acta Revisor');
        $sheet->setCellValue('E4', 'Número Identificación Socio');
        $sheet->setCellValue('F4', 'Fecha Registro Socio');
        $sheet->setCellValue('G4', 'Número ó Porcentaje Acciones');
        $sheet->setCellValue('H4', 'Número Título');
        $sheet->setCellValue('I4', 'Número Resolución');
        $sheet->setCellValue('J4', 'Fecha Resolución');
        $sheet->setCellValue('K4', 'Rangos Numeración');
        $sheet->setCellValue('L4', 'Observaciones');
        $sheet->setCellValue('M4', 'Tamaño Empresa');
        $sheet->setCellValue('N4', 'Activa ó Inactiva');

        //Agregar los datos de la empresa
        $sheet->setCellValue('A2', $empresa->codigo_empresa);
        $sheet->setCellValue('B2', $empresa->tipo_empresa);
        $sheet->setCellValue('C2', $empresa->numero_identificacion);
        $sheet->setCellValue('D2', $empresa->persona_juridica);
        $sheet->setCellValue('E2', $empresa->primer_nombre);
        $sheet->setCellValue('F2', $empresa->segundo_nombre);
        $sheet->setCellValue('G2', $empresa->primer_apellido);
        $sheet->setCellValue('H2', $empresa->segundo_apellido);
        $sheet->setCellValue('I2', $empresa->razon_social);
        $sheet->setCellValue('J2', $empresa->nombre_comercial);
        $sheet->setCellValue('K2', $empresa->numero_identificacion_repre);
        $sheet->setCellValue('L2', $empresa->fecha_inicio_repre);
        $sheet->setCellValue('M2', $empresa->numero_acta_repre);
        $sheet->setCellValue('N2', $empresa->numero_identificacion_suplente);
        $sheet->setCellValue('O2', $empresa->fecha_inicio_suplente);
        $sheet->setCellValue('P2', $empresa->numero_acta_suplente);
        $sheet->setCellValue('Q2', $empresa->numero_identificacion_contador);
        $sheet->setCellValue('R2', $empresa->fecha_inicio_contador);
        $sheet->setCellValue('S2', $empresa->tarjeta_profesional_contador);

        $sheet->setCellValue('A5', $empresa->numero_identificacion_revisor);
        $sheet->setCellValue('B5', $empresa->fecha_inicio_revisor);
        $sheet->setCellValue('C5', $empresa->tarjeta_profesional_revisor);
        $sheet->setCellValue('D5', $empresa->numero_acta_revisor);
        $sheet->setCellValue('E5', $empresa->numero_identificacion_socio);
        $sheet->setCellValue('F5', $empresa->fecha_registro_socio);
        $sheet->setCellValue('G5', $empresa->numero_acciones);
        $sheet->setCellValue('H5', $empresa->numero_titulo);
        $sheet->setCellValue('I5', $empresa->numero_resolucion);
        $sheet->setCellValue('J5', $empresa->fecha_resolucion);
        $sheet->setCellValue('K5', $empresa->rangos_numeracion);
        $sheet->setCellValue('L5', $empresa->observaciones);
        $sheet->setCellValue('M5', $empresa->tamano_empresa);
        $sheet->setCellValue('N5', $empresa->active);

        // Ajustar el ancho de las columnas automáticamente según el contenido
        foreach (range('A', 'S') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Generar el archivo Excel y guardarlo
        $writer = new Xlsx($spreadsheet);
        $filename = 'empresa_data.xlsx';
        $writer->save($filename);

        // Descargar el archivo Excel generado
        return response()->download($filename)->deleteFileAfterSend(true);

    }
}