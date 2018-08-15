<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldInTableGoodsCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //添加新字段
        Schema::table('cy_goods_category', function(Blueprint $table){
            $table->tinyInteger('status')->unsigned()->default(0)->comment('0正常 9 删除');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //回滚操作
        Schema::table('cy_goods_category', function(Blueprint $table){
            $table->dropColumn('status');
        });
    }
}
