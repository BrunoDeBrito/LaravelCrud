<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductConfigOption extends Model
{
    protected $table = 'product_config_options';
    public $timestamps = false;

    use HasFactory;
}
