<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_news', function (Blueprint $table) {
            $table->increments('news_id');
            $table->integer('cate_new_id');
            $table->string('news_title');
            $table->text('news_desc');
            $table->text('news_content');
            $table->string('news_meta_desc');
            $table->string('news_meta_keyword');
            $table->string('news_image');
            $table->integer('news_status');
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
        Schema::dropIfExists('tbl_news');
    }
}
