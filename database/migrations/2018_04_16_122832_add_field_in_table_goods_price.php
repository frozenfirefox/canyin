<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldInTableGoodsPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //添加新字段
        Schema::table('cy_goods_price', function(Blueprint $table){
            $table->string('goods_attr', 255)->default('')->comment('商品价格属性');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    { //回滚字段
        Schema::table('cy_goods_price', function(Blueprint $table){
            $table->dropColumn('goods_attr');
        });
    }
}
