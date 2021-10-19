<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductConfigOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_config_options', function (Blueprint $table) {

            $table->id();
            
            $table->foreignId('product_config_id');
            $table->foreignId('parameter_option_id');

            $table->foreign('product_config_id')->references('id')->on('product_configs');
            $table->foreign('parameter_option_id')->references('id')->on('parameters_options');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        
        Schema::dropIfExists('product_config_options');
    }
}
