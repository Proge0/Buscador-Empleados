<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anexos;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CSVExportController extends Controller
{
    public function export()
    {
        $anexos = Anexos::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Número Público');
        $sheet->setCellValue('B1', 'Número de Anexo');
        $sheet->setCellValue('C1', 'Nombre de Anexo');
        $sheet->setCellValue('D1', 'Departamento');

        $row = 2;
        foreach ($anexos as $anexo) {
            $sheet->setCellValue('A' . $row, $anexo->numeros_publicos);
            $sheet->setCellValue('B' . $row, $anexo->anexo);
            $sheet->setCellValue('C' . $row, $anexo->nombre_anexo);
            $sheet->setCellValue('D' . $row, $anexo->departamento);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'anexos' . date('Y-m-d') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
