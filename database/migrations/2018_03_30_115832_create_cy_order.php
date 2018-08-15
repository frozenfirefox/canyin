<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCyOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //订单表
        Schema::create('cy_order', function(Blueprint $table){
            $table->increments('id')->unsigned()->comment('主键id');
            $table->string('order_sn', 255)->default('')->comment('订单号');
            $table->string('merchant_name', 255)->default('')->comment('商家名称');
            $table->integer('merchant_id')->unsigned()->defaut(0)->comment('商家id');
            $table->integer('user_id')->unsigned()->comment('用户id');
            $table->tinyInteger('order_type')->unsigned()->default(0)->comment('订单类型 订单类型待定');
            $table->string('receiver', 255)->default('')->comment('收货人');
            $table->string('phone', 255)->default('')->comment('收货人电话');
            $table->string('address', 255)->default('')->comment('收货人详细地址');
            $table->integer('pay_type')->unsigned()->default(0)->comment('支付方式： 1：微信支付 2：支付宝 3：银联支付 4：余额支付 5：积分支付 6：...');
            $table->tinyInteger('order_status')->unsigned()->default(0)->comment('订单状态 0：待支付 1：代发货 2：待收货 3：待评价 4：已完成 5：已取消 9：删除');
            $table->tinyInteger('settlement_status')->unsigned()->default(0)->comment('0:不需要 1：需要');
            $table->string('settlement_time', 12)->comment('计划任务执行时间');
            $table->string('settlement_end_time', 12)->comment('计划任务完成时间');
            $table->tinyInteger('pay_status')->unsigned()->default(0)->comment('支付状态 0 未支付 1 已支付');
            $table->string('order_goods_id', 100)->comment('订单商品表id');
            $table->integer('goods_num')->comment('商品数量');
            $table->integer('use_integral')->unsigned()->default(0)->comment('使用积分');
            $table->decimal('pay_tickets', 20,2)->default(0.00)->comment('实际劵支付金额');
            $table->tinyInteger('ticket_color')->unsigned()->default(0)->comment('0未使用代金券 1红 2黄 3蓝');
            $table->decimal('order_price', 20, 2)->default(0.00)->comment('订单总价');
            $table->decimal('freight', 10, 2)->comment('运费');
            $table->integer('pay_time')->unsigned()->default(0)->comment('支付时间');
            $table->tinyInteger('comment_status')->unsigned()->default(0)->comment('订单评论状态 0 未评论  1已评论');
            $table->string('wx_sn', 64)->default('')->comment('微信支付订单号');
            $table->decimal('return_integral', 10, 2)->default(0.00)->comment('返还积分数');

            $table->tinyInteger('is_tax')->unsigned()->default(0)->comment('是否开具发票');
            $table->decimal('express_fee', 20, 2)->default(0.00)->comment('发票运费');
            $table->decimal('tax_pay', 5, 2)->default(0.00)->comment('发票税金');
            $table->decimal('welfare', 5, 2)->default(0.00)->comment('公益金额');
            $table->text('mark')->comment('留言');
            $table->decimal('import_tax', 20, 2)->defaut(0.00)->comment('进口税总额');
            $table->integer('create_time')->unsigned()->default(0)->comment('订单生成时间');
            $table->integer('update_at')->unsigned()->default(0)->comment('订单更新时间');
            $table->string('other', 255)->default('')->comment('扩展字段');
        });
        DB::statement("ALTER TABLE `cy_ticket` comment'餐饮平台订单表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //回滚操作
        Schema::drop('cy_order');
    }
}
