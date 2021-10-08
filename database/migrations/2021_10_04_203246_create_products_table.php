<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{

  public function up() {

    Schema::create('products', function (Blueprint $table) {

      $table->bigIncrements('id');

	  $table->unsignedBigInteger('category_id');

      $table->string('name', 100);
      $table->float('price');
      $table->text('descriptions')->nullable();

      $table->foreign('category_id')->references('id')->on('categories');


      $table->timestamps();

    });
  }

  public function down() {

    Schema::dropIfExists('products');

  }
}
