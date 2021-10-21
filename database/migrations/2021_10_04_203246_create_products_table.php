<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{

  /**
   * Undocumented function
   *
   * @return void
   */
  public function up()
  {

    Schema::create('products', function (Blueprint $table) {

      $table->bigIncrements('id');
      $table->foreignId('category_id');
      $table->string('name', 100);
      $table->text('descriptions')->nullable();
      $table->timestamps();

      $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');

    });
  }

  public function down()
  {

    Schema::dropIfExists('products');
  }
}
