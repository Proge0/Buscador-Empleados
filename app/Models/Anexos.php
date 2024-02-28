<?php

// app/Models/Anexo.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anexos extends Model
{   
    public $timestamps = false;
    protected $table = 'anexos';
    protected $fillable = ['id', 'numeros_publicos', 'anexo', 'nombre_anexo', 'departamento'];
}

