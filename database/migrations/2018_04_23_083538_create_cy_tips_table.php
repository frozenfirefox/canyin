<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCyTipsTable extends Migration
{
    /**
     * Run the migrations.
     * 构建餐饮系统打赏表
     * @return void
     */
    public function up()
    {
        Schema::create('cy_tips', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('ID');
            $table->integer('ct_user_id')->comment('客户ID');
            $table->string('ct_qrcode', 255)->comment('原始二维码');
            $table->integer('ct_bus_id')->comment('商户ID');
            $table->integer('ct_tuser_id')->comment('用户ID');
            $table->integer('ct_order_id')->comment('订单ID');
            $table->integer('ct_food_id')->comment('菜品ID');
            $table->tinyInteger('ct_target')->unsigned()->default(0)->comment('打赏对象');
            $table->tinyInteger('ct_paytype')->unsigned()->default(0)->comment('支付方式');
            $table->decimal('ct_amount', 8, 2)->default(0.00)->comment('打赏金额');
            $table->string('ct_memo', 255)->comment('简评');
            $table->tinyInteger('ct_status')->unsigned()->default(0)->comment('打赏状态');
            $table->integer('ct_create_time')->unsigned()->default(0)->comment('登录日期');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cy_tips');
    }
}
