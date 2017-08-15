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
            $table->string('id', 20)->unique();
            $table->string('name')->nullable();
            $table->string('phone')->nullable()->unique();
            $table->string('address')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
