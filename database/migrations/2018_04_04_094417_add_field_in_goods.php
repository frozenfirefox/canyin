<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldInGoods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //添加新字段
        Schema::table('cy_goods', function(Blueprint $table){
            $table->tinyInteger('status')->after('is_refer')->unsigned()->default(0)->comment('商品状态 0 默认都是正常的');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //回滚 删除字段
        Schema::table('cy_goods', function ($table) {
            $table->dropColumn('status');
        });
    }
}
