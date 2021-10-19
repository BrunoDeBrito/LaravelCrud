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
    /**
     * Obetem as opções do parametro
     *
     * @return void
     */
    public function options() {

        return $this->hasMany(ParameterOption::class)
        ->orderBy('id', 'asc');
        
    }

    /**
     * obtem os produtos
     *
     * @return void
     */
    public function products() {
        
        return $this->belongsToMany(Product::class)
		->orderBy('id', 'asc');
    }

    protected $table = 'parameters';

    public $date = [
        'created_at', 'updated_at'
    ];


}
