<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InventorysOfCustomers extends Migration
{
    /**
     * Bảng inventorys_of_customers: id_inventorys(FK), id_customers(FK)
     *
     * Description   : Bảng kết hợp nhiều - nhiều giữa: inventorys và customers
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventorys_of_customers', function (Blueprint $table) {
            $table->string('id_inventorys')->unsigned();
            $table->integer('id_customers')->unsigned();
            $table->foreign('id_inventorys')->references('id')->on('inventorys')->onDelete('cascade');
            $table->foreign('id_customers')->references('name')->on('customers')->onDelete('cascade');
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
        Schema::dropIfExists('inventorys_of_customers');
    }
}
