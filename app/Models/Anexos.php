<?php

// app/Models/Anexo.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anexos extends Model
{
    protected $table = 'anexos';
    // Asegúrate de tener correctamente especificados los campos de la tabla
    protected $fillable = ['ID', 'numero_publico', 'anexo', 'nombre_anexo', 'departamento'];
}

