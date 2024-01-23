<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plantilla extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'Plantillas';
    public $fillable = ['referencia', 'CreadoPor', 'ModificadoPor', 'Body', 'Encabezado'];
}
