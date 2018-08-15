<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldInGoodsAttr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //商品属性表
        Schema::table('cy_goods_attr', function(Blueprint $table){
            $table->integer('businesses_id')->unsigned()->default(0)->comment('商户id');
            $table->integer('classes_type')->unsigned()->default(0)->comment('自定义属性类别');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //回退修改
        Schema::table('cy_goods_attr', function(Blueprint $table){
            $table->dropColumn(['businesses_id', 'classes_type']);
        });
    }
}
