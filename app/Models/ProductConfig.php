<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductConfig extends Model
{
    use HasFactory;
    protected $table = 'product_configs';

    /**
     * Obetem os produtos
     *
     * @return void
     */
    public function product() {
        
        return $this->belongsTo(Product::class)
		->orderBy('id', 'asc');
    }

    /**
     * Obetem as opções do parametos
     *
     * @return void
     */
    public function parametersOptions() {

        return $this->belongsToMany(
            'App\Models\ParameterOption',
            'product_config_options',
            'product_config_id',
            'parameter_option_id'
        );

    }


}
