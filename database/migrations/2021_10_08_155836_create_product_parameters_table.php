<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_parameters', function (Blueprint $table) {

            $table->id();

            //Tabela Pivo
            $table->unsignedBigInteger('products_id');
            $table->unsignedBigInteger('parameter_id');

            $table->foreign('parameter_id')->references('id')->on('parameters');
            $table->foreign('products_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_paramenters');
    }
}
