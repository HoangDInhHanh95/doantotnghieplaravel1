<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCategoryProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_category_product', function (Blueprint $table) {
            $table->id(); //=> Increments => tự tăng của id
            $table->string('category_name');
            $table->string('category_desc'); //=> kiểu giá trị là kiểu chuỗi
            $table->integer('category_status'); // => integer kiểu giá trị là kiêu int
            $table->timestamps(); //=> timestamps => lấy ngày hiện tại
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_category_product');
    }
}
