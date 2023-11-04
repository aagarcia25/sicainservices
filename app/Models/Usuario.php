<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Usuario
 *
 * @property uuid $Id
 * @property string $Usuario
 * @property string $Password
 *
 * @package App\Models
 */
class Usuario extends Model
{
    public $table = 'Usuarios';
    public $incrementing = false;
    public $timestamps = false;
    public $primaryKey = 'id';

    protected $_fillable = [
        'Usuario',
        'Password',
    ];
}
