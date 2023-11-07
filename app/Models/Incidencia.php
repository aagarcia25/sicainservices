<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Incidencia
 *
 * @property uuid $Id
 * @property string|null $Foto
 * @property string|null $Observaciones
 * @property uuid|null $IdEmpleado
 *
 * @property Empleado|null $empleado
 *
 * @package App\Models
 */
class Incidencia extends Model
{
    public $table = 'Incidencias';
    public $incrementing = false;
    public $timestamps = false;
    public $primaryKey = 'Id';

    public $fillable = [
        'Foto',
        'Observaciones',
        'IdEmpleado',
        'FechaCreación',
        'CreadoPor',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'IdEmpleado');
    }
}
