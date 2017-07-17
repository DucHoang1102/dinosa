<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductsOfOrders extends Migration
{
    /**
     * Bảng products_of_orders: id_order(FK), id_category_product(FK), id_image_print (FK),
     * id_embryo_tshirt(FK), name(Tên sản phẩm kết hợp 3 cái kia)
     *
     * Description   : Bảng kết hợp nhiều - nhiều giữa: orders và products
     * @return void
     */
    public function up()
    {
        Schema::create('products_of_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_orders')->unsigned();
            $table->string('name_category_product');
            $table->string('name_image_print');
            $table->string('name_embryo_tshirt');
            $table->foreign('id_orders')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('name_category_product')->references('name')->on('category_product')->onDelete('cascade');
            $table->foreign('name_image_print')->references('name')->on('image_print')->onDelete('cascade');
            $table->foreign('name_embryo_tshirt')->references('name')->on('embryo_tshirt')->onDelete('cascade');
            $table->string('name');
            $table->string('size');
            $table->string('status', 1);
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
        Schema::dropIfExists('products_of_orders');
    }
}
