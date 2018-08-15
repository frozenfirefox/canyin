<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldInBusinesses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //添加新字段
        Schema::table('cy_businesses', function(Blueprint $table){
            $table->tinyInteger('status')->unsigned()->default(0)->comment('商户状态 0 默认都是正常的');
            $table->integer('parent_id')->unsigned()->default(0)->comment('商户父id 如果为 0则为顶层商户 否则为子商户');
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
        Schema::table('cy_businesses', function ($table) {
            $table->dropColumn('status');
            $table->dropColumn('parent_id');
        });
    }
}
