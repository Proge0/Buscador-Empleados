<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use App\Models\Anexos;
class CSVImportController extends Controller
{

    // Método para importar datos desde un archivo CSV a la base de datos
    public function import(Request $request)
        {
            // Validación del archivo de entrada, asegurando que sea de tipo csv, txt o xlsx
            $request->validate([
                'file' => 'required|mimes:csv,txt,xlsx',
            ]);
            // Obtiene el archivo del formulario y la ruta real del archivo
            $file = $request->file('file');
            $filepath = $file->getRealPath();

            // Crea una instancia de la clase Csv para leer el archivo, carga el archivo en un objeto spreadsheet, obtiene una hoja de calculo activa
            // obtiene el número de la hoja más alto y inicializa un arreglo para almacenar los datos en la tabla Anexos
            $reader = new Csv();
            $spreadsheet = $reader->load($filepath);
            $sheet = $spreadsheet->getActiveSheet();
            $highestRow = $sheet->getHighestRow();
            $anexos = [];

            // Itera sobre las filas a partir de la segunda, ya que la primera suele contener encabezados
            for ($row = 2; $row <= $highestRow; $row++) {
                    $numero_publico = $sheet->getCell('A'.$row)->getValue();
                    $anexo = $sheet->getCell('B'.$row)->getValue();
                    $nombre_anexo = $sheet->getCell('C'.$row)->getValue();
                    $departamento = $sheet->getCell('D'.$row)->getValue();
                
                // Busca si ya existe un Anexo con el mismo número de anexo en la base de datos
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
            // Inserta los datos de Anexos en la base de datos
            Anexos::insert($anexos);

            return redirect()->back()->with('success', 'Los anexos se han importado correctamente.');
        }
}