<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnsInOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //更改订单表
        Schema::table('cy_order', function(Blueprint $table){
            $table->string('order_goods_id', 100)->default('')->comment('订单商品表id')->change();
            $table->integer('goods_num')->unsigned()->default(0)->comment('商品数量')->change();
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
        Schema::table('cy_order', function(Blueprint $table){
            $table->string('order_goods_id', 100)->default('')->comment('订单商品表id')->change();
            $table->integer('goods_num')->unsigned()->default(0)->comment('商品数量')->change();
        });
    }
}
