<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ImagePrint extends Migration
{
    /**
     * Bảng image_print: id, name, description, price
     * Description: Bảng danh sách ảnh in
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_print', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->bigInteger('price');
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
