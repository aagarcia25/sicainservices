<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Bitacora
 *
 * @property uuid $Id
 * @property uuid $IdEmpleado
 * @property Carbon $Fecha
 * @property Carbon $HoraEntrada
 * @property Carbon $HoraSalida
 *
 * @property Empleado $empleado
 *
 * @package App\Models
 */
class Bitacora extends Model
{
    public $table = 'Bitacora';
    public $primaryKey = 'Id';
    public $incrementing = false;
    public $timestamps = false;

    public $casts = [
        'IdEmpleado' => 'uuid',
        'Fecha' => 'datetime',
        'HoraEntrada' => 'datetime',
        'HoraSalida' => 'datetime',
    ];

    public $fillable = [
        'IdEmpleado',
        'Fecha',
        'HoraEntrada',
        'HoraSalida',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'IdEmpleado');
    }
}
