<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Customers extends Migration
{
    /**
     * Bảng customers: id, name, phone, address, noted, deal_history
     * deal_history  : Lịch sử giao dịch
     * noted         : Ghi chú khách hàng
     * Description   : Bảng danh sách khách hàng
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('phone');
            $table->string('address');
            $table->string('noted', 1000);
            $table->string('deal_history', 1000)
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
        Schema::dropIfExists('customers');
    }
}
