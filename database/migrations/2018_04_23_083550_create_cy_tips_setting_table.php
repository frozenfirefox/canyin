<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCyTipsSettingTable extends Migration
{
    /**
     * Run the migrations.
     * 构建餐饮系统商户打赏设置表
     * @return void
     */
    public function up()
    {
        Schema::create('cy_tips_setting', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('商户ID');
            $table->tinyInteger('cts_type')->unsigned()->default(0)->comment('现金结算方法');
            $table->tinyInteger('cts_smileflag')->unsigned()->default(0)->comment('有无笑脸打赏');
            $table->decimal('cts_smilerate', 5, 2)->default(0.00)->comment('笑脸兑换率');
            $table->tinyInteger('cts_smilemin')->unsigned()->default(0)->comment('笑脸起结数');
            $table->string('cts_def_amount', 255)->comment('打赏金额多选项');
            $table->string('cts_memo', 255)->comment('备考');
            $table->integer('cts_create_time')->unsigned()->default(0)->comment('登录日期');
            $table->string('cts_create_user', 255)->comment('登录者');
            $table->integer('cts_update_time')->unsigned()->default(0)->comment('更新日期');
            $table->string('cts_update_user', 255)->comment('更新者');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cy_tips_setting');
    }
}
