<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCyTicket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //餐饮网优惠券
        Schema::create('cy_ticket', function(Blueprint $table){
            $table->increments('id')->unsigned()->comment('主键id');
            $table->string('ticket_code', 40)->unique()->comment('优惠券 唯一id');
            $table->string('ticket_name', 255)->default('')->comment('优惠券名称');
            $table->string('ticket_desc')->default('')->comment('优惠券的说明');
            $table->tinyInteger('ticket_type')->unsigned()->default(1)->comment('优惠券类型 1 满减 2满折 3满赠');
            $table->string('value', 255)->default('')->comment('面值 满减（金额） 满赠（goodsid） 满折（1-10）');
            $table->integer('condition')->unsigned()->default(0)->comment('0 表示无条件使用 其他填写条件金额');
            $table->integer('merchant_id')->unsigned()->default(0)->comment('商家id 默认0 表示后台发放');
            $table->integer('true_use_num')->unsigned()->default(0)->comment('使用数量');
            $table->integer('limit_num')->unsigned()->default(1)->comment('0表示不限制 默认为1');
            $table->integer('ticket_num')->unsigned()->default(0)->comment('0 表示没有上限');
            $table->integer('use_num')->unsigned()->default(0)->comment('被领走数量');
            $table->integer('goods_id')->unsigned()->default(0)->comment('0表示针对全店');
            $table->integer('status')->unsigned()->default(0)->comment('0未发布 1发布 9 删除');
            $table->integer('start_time')->unsigned()->default(0)->comment('有效期开始时间');
            $table->integer('end_time')->unsigned()->default(0)->comment('有效期结束时间');
            $table->integer('create_at')->unsigned()->default(0)->comment('创建时间');
            $table->integer('update_at')->unsigned()->default(0)->comment('更新时间');
            $table->string('other', 255)->default('')->comment('扩展字段');
        });
        DB::statement("ALTER TABLE `cy_ticket` comment'餐饮平台优惠券表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //回滚操作
        Schema::drop('cy_ticket');
    }
}
