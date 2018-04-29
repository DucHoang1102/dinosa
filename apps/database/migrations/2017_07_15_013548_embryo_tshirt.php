<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmbryoTshirt extends Migration
{
    /**
     * Bảng embryo_tshirt: id, name, description, price
     * Description: Bảng danh sách phôi áo
     *
     * @return void
     */
    public function up()
    {
        Schema::create('embryo_tshirt', function (Blueprint $table) {
            $table->string('name', 5)->unique();
            $table->string('description', 100);
            $table->timestamps();

            $table->primary('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('embryo_tshirt');
    }
}
