<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Incidencia
 * 
 * @property string $Id
 * @property string|null $Foto
 * @property string|null $Observaciones
 * @property string|null $IdEmpleado
 * @property Carbon $FechaCreacion
 * @property string|null $CreadoPor
 *
 * @package App\Models
 */
class Incidencia extends Model
{
	protected $table = 'Incidencias';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'FechaCreacion' => 'datetime'
	];

	protected $fillable = [
		'Id',
		'Foto',
		'Observaciones',
		'IdEmpleado',
		'FechaCreacion',
		'CreadoPor'
	];
}
