<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCyOrderGoods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //订单表
        Schema::create('cy_order_goods', function(Blueprint $table){
            $table->increments('id')->unsigned()->comment('主键id');
            $table->integer('order_id')->unsigned()->comment('订单id');
            $table->string('merchant_name', 255)->default('')->comment('商家名称');
            $table->integer('merchant_id')->unsigned()->defaut(0)->comment('商家id');
            $table->integer('goods_id')->unsigned()->comment('商品id');
            $table->string('goods_attr', 255)->default('')->comment('商品属性组合');
            $table->decimal('settlement_price', 10, 2)->default(0.00)->comment('结算价');
            $table->decimal('shop_price', 8, 2)->default(0.00)->comment('销售价');
            $table->decimal('market_price', 8, 2)->default(0.00)->comment('市场价');
            $table->integer('goods_img')->defaut(0)->comment('商品图片');
            $table->decimal('discount', 5, 2)->default(0.00)->comment('红劵使用比例');
            $table->decimal('yellow_discount', 5, 2)->default(0.00)->comment('黄券使用比例');
            $table->decimal('blue_discount', 5, 2)->default(0.00)->comment('蓝券使用比例');
            $table->decimal('red_return_integral', 20, 2)->default(0.00)->comment('红券返回积分比例');
            $table->decimal('yellow_return_integral', 10, 2)->default(0.00)->comment('黄劵返回积分比例');
            $table->integer('goods_num')->unsigned()->default(0)->comment('购买数量');
            $table->decimal('total', 8, 2)->default(0.00)->comment('小计');
            $table->tinyInteger('send_type')->unsigned()->default(0)->comment('配送方式0 不配送 1：蜂鸟配送 2：等其他');
            $table->string('send_company', 255)->default('')->comment('快递id');
            $table->string('send_nu', 64)->default('')->comment('运单号');
            $table->integer('delivery_time')->unsigned()->default(0)->comment('配送时间');
            $table->tinyInteger('status')->unsigned()->default(0)->comment('状态 1：已收货 2：未收货 3：延时收货');
            $table->integer('sure_delivery_time')->unsigned()->default(0)->comment('确认收货时间');
            $table->tinyInteger('after_type')->unsigned()->default(0)->comment('退换货状态 0 正常 1退货');
            $table->tinyInteger('comment_status')->unsigned()->default(0)->comment('评论状态 1为已评价');
            $table->tinyInteger('is_sales')->unsigned()->default(0)->comment('商家是否同意退货 1：同意 0：否');
            $table->tinyInteger('is_invoice')->unsigned()->default(0)->comment('是否开发票（0否，1是）');
            $table->tinyInteger('invoice_type_id')->unsigned()->default(0)->comment('发票类型id');
            $table->tinyInteger('invoice_rise')->unsigned()->default(0)->comment('发票抬头类型（1->个人，2->公司）');
            $table->string('rise_name', 255)->default('')->comment('抬头名');
            $table->string('invoice_detail', 255)->default('')->comment('发票明细');
            $table->string('recognition', 255)->default('')->comment('识别号');
            $table->decimal('tax_pay', 10, 2)->default(0.00)->comment('税金金额');
            $table->integer('express_fee')->default(0)->comment('发票运费');

            $table->integer('create_time')->unsigned()->default(0)->comment('订单生成时间');
            $table->integer('update_at')->unsigned()->default(0)->comment('订单更新时间');
            $table->string('other', 255)->default('')->comment('扩展字段');
        });
        DB::statement("ALTER TABLE `cy_ticket` comment'餐饮平台订单商品表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //回滚操作
        Schema::drop('cy_order_goods');
    }
}
