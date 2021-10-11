<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Models de Parametros
 *
 * @author Bruno de Brito <bruno@sysout.com.br>
 * @since 08/10/2021 
 * @version 1.0.0
 */
class Parameter extends Model
{
    use HasFactory;

    protected $table = 'parameters';

    public $date = [

        'created_at', 'updated_at'
    ];
}
