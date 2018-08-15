<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductcategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //商品分类
        Schema::table('cy_goods_category', function (Blueprint $table) {
            $table->tinyInteger('type')->unsigned()->default(0)->comment('类型');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //滚回操作
        Schema::table('cy_goods_category', function ($table) {
            $table->dropColumn('type');
        });
    }
}
