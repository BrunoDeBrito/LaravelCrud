<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Model de Parametros opcionais
 *
 * @author Bruno de Brito <bruno@sysout.com.br>
 * @since 08/10/2021 
 * @version 1.0.0
 */
class ParamenterOption extends Model
{
    use HasFactory;

    protected $table = 'paramenters_options';
    
    public $dates = [

        'created_at', 'updated_at'
    
    ];

}