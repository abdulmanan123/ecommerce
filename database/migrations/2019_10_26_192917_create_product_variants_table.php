<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->index()->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade'); 
            $table->bigInteger('variant_id')->index()->unsigned();
            $table->foreign('variant_id')->references('id')->on('variants')->onDelete('cascade');            
            $table->string('name', 200)->nullable();            
            $table->string('sku',100)->nullable();            
            $table->integer('cost')->default(0);            
            $table->integer('price')->default(0);            
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
        Schema::drop('product_variants');
    }
}
