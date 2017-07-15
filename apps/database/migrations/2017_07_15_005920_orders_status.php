<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrdersStatus extends Migration
{
    /**
     * Bảng oders_status: id, name, description
     * Description: Bảng trạng thái đơn hàng
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oders_status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
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
        Schema::dropIfExists('oders_status');
    }
}
