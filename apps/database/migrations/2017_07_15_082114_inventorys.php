<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Inventorys extends Migration
{
    /**
     * Bảng customers: name(khóa chính), history(Số lần bị tồn), status(0|1 - Có | Không)
     * 
     * Description   : Bảng theo dõi hàng tồn kho
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventorys', function (Blueprint $table) {
            $table->string('name')->unique();
            $table->integer('history');
            $table->integer('status');
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
        Schema::dropIfExists('inventorys');
    }
}
