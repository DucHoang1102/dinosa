<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ImagePrint extends Migration
{
    /**
     * Bảng image_print: id, name, src, description, price, name_category_product(FK)
     * Description: Bảng danh sách ảnh in
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_print', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('src');
            $table->string('description');
            $table->string('name_category_product');
            $table->bigInteger('price');
            $table->foreign('name_category_product')->references('name')->on('category_product')->onDelete('cascade');
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
        Schema::dropIfExists('image_print');
    }
}
