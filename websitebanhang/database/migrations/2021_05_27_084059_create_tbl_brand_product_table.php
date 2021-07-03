<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblBrandProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_brand_product', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name');
            $table->string('brand_desc'); //=> kiểu giá trị là kiểu chuỗi
            $table->integer('brand_status'); // => integer kiểu giá trị là kiêu int
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
        Schema::dropIfExists('tbl_brand_product');
    }
}
