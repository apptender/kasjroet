<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packaging', function(Blueprint $table){
           $table->bigIncrements('id');
           $table->string('packageingtype')->nullable(false);
           $table->string('packagingquantity')->nullable(false);
           $table->softDeletes();
           $table->timestamps();
        });


        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('brand_id')->unsigned()->index();
            $table->string('informationsource')->nullable();
            $table->string('eancode')->unique();
            $table->boolean('kosher')->default(0);
            $table->string('koshertype')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('brand_id')->references('id')->on('brands');
        });

        Schema::create('products_ingredients', function(Blueprint $table){
           $table->bigIncrements('id');
           $table->unsignedBigInteger('products_id')->unsigned()->index();
           $table->unsignedBigInteger('ingredients_id')->unsigned()->index();

           $table->foreign('products_id')->references('id')->on('products')->onDelete('cascade');
           $table->foreign('ingredients_id')->references('id')->on('ingredients')->onDelete('cascade');
        });

        Schema::create('products_packaging', function(Blueprint $table){
           $table->bigIncrements('id');
            $table->unsignedBigInteger('products_id')->unsigned()->index();
            $table->unsignedBigInteger('packaging_id')->unsigned()->index();

            $table->foreign('products_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('packaging_id')->references('id')->on('packaging')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('products_ingredients');
        Schema::dropIfExists('packaging');
    }
}
