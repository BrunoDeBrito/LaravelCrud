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
    public function up() {

        Schema::create('parameters_options', function (Blueprint $table) {

            $table->id();
            $table->foreignId('parameter_id');
            $table->string('name', 100);
            $table->timestamps();

            $table->foreign('parameter_id')->references('id')->on('parameters')->onDelete('cascade');

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
