<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Bitacora.
 *
 * @property string      $Id
 * @property string      $IdEmpleado
 * @property Carbon      $Fecha
 * @property string|null $HoraEntrada
 * @property string|null $HoraSalida
 * @property Carbon|null $FechaCreacion
 * @property int         $Completado
 */
class Bitacora extends Model
{
    protected $table = 'Bitacora';
    protected $primaryKey = 'Id';
    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'Fecha' => 'datetime',
        'FechaCreacion' => 'datetime',
        'Completado' => 'int',
    ];

    protected $fillable = [
        'IdEmpleado',
        'Fecha',
        'HoraEntrada',
        'HoraSalida',
        'FechaCreacion',
        'Completado',
    ];
}
