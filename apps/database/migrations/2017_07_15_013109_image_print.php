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
            $table->string('id', 12)->unique();
            $table->string('url',100)->unique();
            $table->timestamps();

            $table->primary('id');
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
