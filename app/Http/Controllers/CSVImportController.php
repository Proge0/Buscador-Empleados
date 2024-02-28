<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use App\Models\Anexos;
class CSVImportController extends Controller
{
public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('file');
        $filepath = $file->getRealPath();

        $reader = new Csv();
        $spreadsheet = $reader->load($filepath);
        $sheet = $spreadsheet->getActiveSheet();
        $highestRow = $sheet->getHighestRow();
        $anexos = [];

        for ($row = 1; $row <= $highestRow; $row++) {
                $numero_publico = $sheet->getCell('A'.$row)->getValue();
                $anexo = $sheet->getCell('B'.$row)->getValue();
                $nombre_anexo = $sheet->getCell('C'.$row)->getValue();
                $departamento = $sheet->getCell('D'.$row)->getValue();

            $anexoExistente = Anexos::where('anexo', $anexo)->first();

            if (!$anexoExistente) {
                $anexos[] = [
                    'numeros_publicos' => $numero_publico,
                    'anexo' => $anexo,
                    'nombre_anexo' => $nombre_anexo,
                    'departamento' => $departamento,
                ];
            }
        }

        Anexos::insert($anexos);

        return redirect()->back()->with('success', 'Los anexos se han importado correctamente.');
    }
}