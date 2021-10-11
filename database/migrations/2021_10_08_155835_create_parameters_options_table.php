<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParametersOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paramenters_options', function (Blueprint $table) {

            $table->id();

            $table->foreignId('parameter_id');
            
            $table->string('name', 100);

            $table->foreign('parameter_id')->references('id')->on('parameters')->onDelete('set null');
            
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parameters_options');
    }
}