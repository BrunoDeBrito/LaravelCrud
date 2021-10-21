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
class ParameterOption extends Model
{
    
    protected $table = 'parameters_options';
    
    use HasFactory;

    /**
     * obtem os parametros
     *
     * @return void
     */
    public function parameter() {

        return $this->belongsTo(Parameter::class)
        ->orderBy('id', 'asc');
    }

    /**
     * Obtem os produtos
     *
     * @return void
     */
    public function products() {
        
        return $this->belongsToMany(Products::class)
        ->orderBy('id', 'asc');
    }

    public function configParameterOption() {

        // return $this->belongsToMany(

        //     'App\Models\ParameterOption', 
        //     'product_config_options', 
        //     'product_config_id', 
        //     'parameter_option_id'

        // );

    }

    
}
