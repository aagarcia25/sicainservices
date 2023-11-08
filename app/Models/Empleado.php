<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Empleado
 *
 * @property uuid $Id
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
    public $table = 'Empleados';
    public $incrementing = false;
    public $timestamps = false;
    public $primaryKey = 'Id';

    protected $_casts = [
        'NumeroEmpleado' => 'int',
    ];

    protected $_fillable = [
        'NumeroEmpleado',
        'Nombre',
        'ApellidoP',
        'ApellidoM',
        'RazonSocial',
    ];

    public function bitacoras()
    {
        return $this->hasMany(Bitacora::class, 'IdEmpleado');
    }
}
