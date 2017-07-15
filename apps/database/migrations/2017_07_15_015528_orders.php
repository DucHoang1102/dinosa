<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Orders extends Migration
{
    /**
     * Bảng orders: id, id_post(Mã của bưu điện), id_category_product(FK), id_image_print
     * (FK), id_embryo_tshirt(FK), id_customers(FK), id_order_status(FK), name(Tên sản  
     * phẩm kết hợp 3 cái FK kia) timestamp()
     *
     * Description   : Bảng danh sách đơn hàng
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_post')->unique();
            $table->integer('id_category_product')->unsigned();
            $table->integer('id_image_print')->unsigned();
            $table->integer('id_embryo_tshirt')->unsigned();
            $table->integer('id_customers')->unsigned();
            $table->integer('id_orders_status')->unsigned();
            $table->foreign('id_category_product')->references('id')->on('category_product')->onDelete('cascade');
            $table->foreign('id_image_print')->references('id')->on('image_print')->onDelete('cascade');
            $table->foreign('id_embryo_tshirt')->references('id')->on('embryo_tshirt')->onDelete('cascade');
            $table->foreign('id_customers')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('id_orders_status')->references('id')->on('orders_status')->onDelete('cascade');
            $table->string('name');
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
        Schema::dropIfExists('order');
    }
}
