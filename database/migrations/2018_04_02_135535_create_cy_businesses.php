<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCyBusinesses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //新增数据表
        Schema::create('cy_businesses', function(Blueprint $table){
            $table->increments('id')->unsigned()->comment('主键id');
            $table->string('name', 255)->comment('商家名称');
            $table->integer('turnover')->comment('营业额 万元');
            $table->string('phone', 11)->default('')->comment('商家电话');
            $table->string('address', 255)->default('')->comment('地址');
            $table->integer('user_id')->unsigned()->default(0)->comment('商家经理');
            $table->text('description')->default('')->comment('商家描述');
            $table->integer('create_time')->unsigned()->default(0)->comment('订单生成时间');
            $table->integer('update_at')->unsigned()->default(0)->comment('订单更新时间');
            $table->string('other', 255)->default('')->comment('扩展字段');
        });
        DB::statement("ALTER TABLE `cy_businesses` comment'餐饮平台商家表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //回滚操作
        Schema::drop('cy_businesses');
    }
}
