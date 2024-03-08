<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anexos;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CSVExportController extends Controller
{
    // Método para exportar datos de Anexos a un archivo Excel (XLSX)
    public function export()
    {
        $anexos = Anexos::all();

        // Crea una instancia de la clase Spreadsheet
        $spreadsheet = new Spreadsheet();
        // Obtiene la hoja de cálculo activa
        $sheet = $spreadsheet->getActiveSheet();
        // Establece los encabezados de las columnas en la primera fila de la hoja de cálculo
        $sheet->setCellValue('A1', 'Número Público');
        $sheet->setCellValue('B1', 'Número de Anexo');
        $sheet->setCellValue('C1', 'Nombre de Anexo');
        $sheet->setCellValue('D1', 'Departamento');

        $row = 2;

        // Itera sobre los registros de Anexos y llena las celdas correspondientes en la hoja de cálculo
        foreach ($anexos as $anexo) {
            $sheet->setCellValue('A' . $row, $anexo->numeros_publicos);
            $sheet->setCellValue('B' . $row, $anexo->anexo);
            $sheet->setCellValue('C' . $row, $anexo->nombre_anexo);
            $sheet->setCellValue('D' . $row, $anexo->departamento);
            $row++;
        }
        // Crea una instancia de la clase Xlsx para escribir en el formato de archivo XLSX
        $writer = new Xlsx($spreadsheet);

        // Define el nombre del archivo con la fecha actual para evitar sobrescribir archivos existentes
        $filename = 'anexos' . date('Y-m-d') . '.xlsx';

        // Configura las cabeceras HTTP para indicar que se trata de un archivo Excel descargable
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
