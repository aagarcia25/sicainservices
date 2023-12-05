<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Empleado
 * 
 * @property string $Id
 * @property int $NumeroEmpleado
 * @property string $Nombre
 * @property string $ApellidoP
 * @property string $ApellidoM
 * @property string $RazonSocial
 *
 * @package App\Models
 */
class Empleado extends Model
{
	protected $table = 'Empleados';
	protected $primaryKey = 'Id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'NumeroEmpleado' => 'int'
	];

	protected $fillable = [
		'NumeroEmpleado',
		'Nombre',
		'ApellidoP',
		'ApellidoM',
		'RazonSocial'
	];
}
