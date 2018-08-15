<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCyGoodsAttr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //商品属性表
        Schema::create('cy_goods_attr', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('主键id');
            $table->integer('goods_id')->unsigned()->default(0)->comment('商品id');
            $table->integer('goods_attr_id')->unsigned()->default(0)->comment('商品属性id');
            $table->string('goods_attr_value', 255)->default('')->comment('属性值');
            $table->string('goods_attr_assignment', 255)->default('')->comment('复制');
            $table->tinyInteger('status')->default(0)->comment('0正常 9 删除');
        });
        DB::statement("ALTER TABLE `cy_goods_attr` comment'存储商品规格参数里的动态商品属性和属性值表'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //滚回操作
        Schema::drop('cy_goods_attr');
    }
}
