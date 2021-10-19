<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductConfig extends Model
{
    use HasFactory;

    public function product() {
        
        return $this->belongsTo(Product::class)
		->orderBy('id', 'asc');
    }

    public function parameterOptions() {
        return $this->belongsToMany('App\Models\ParameterOption', 'product_config_options', 'product_config_id', 'parameter_option_id');
    }


}
