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
            $table->string('id', 20)->unique();
            $table->string('id_post')->unique();
            $table->string('id_customers');
            $table->integer('id_orders_status')->unsigned();
            $table->integer('surcharge_money')->default(0);
            $table->integer('ship_customer_money')->default(0);
            $table->integer('total_money')->default(0);
            $table->timestamps();

            $table->foreign('id_customers')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('id_orders_status')->references('id')->on('orders_status')->onDelete('cascade');
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
        Schema::dropIfExists('order');
    }
}
