<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCyGoods extends Migration
{
    /**
     * Run the migrations.
     * 构建餐饮系统商品表
     * @return void
     */
    public function up()
    {
        // Create table for 餐饮商品表
        Schema::create('cy_goods', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('主键id');
            $table->integer('price_id')->comment('价格单id');
            $table->integer('merchant_id')->comment('商家id');
            $table->string('merchant_name', 255)->comment('商家名称');
            $table->string('goods_name', 255)->comment('商品名称');
            $table->string('keyword', 255)->default('')->comment('关键字');
            $table->string('goods_brief', 255)->default('')->comment('商品简介');
            $table->text('goods_desc', 25)->default('')->comment('商品详细说明');
            $table->integer('goods_typeid')->default(0)->comment('商品类型 id');
            $table->integer('goods_img')->default(0)->comment('品图片略缩图');
            $table->string('last_ip', 255)->default('')->comment('更新商品ip');
            $table->string('oss_path', 255)->default('')->comment('oss服务器路径');
            $table->decimal('integral', 8, 2)->default(0.00)->comment('积分返还');
            $table->decimal('discount', 5, 2)->default(0.00)->comment('可使用红券数 单位%');
            $table->integer('red_return_integral')->default(0)->comment('红券返积分');
            $table->decimal('yellow_discount', 5, 2)->default(0.00)->comment('黄券使用比例');
            $table->integer('yellow_return_integral')->default(0)->comment('黄券返积分');
            $table->decimal('blue_discount', 5, 2)->default(0.00)->comment('蓝券使用比例');
            $table->tinyInteger('is_limit')->unsigned()->default(0)->comment('是否限购');
            $table->tinyInteger('is_integral_buy')->unsigned()->default(0)->comment('是否可用积分兑换');
            $table->tinyInteger('is_refer')->unsigned()->default(0)->comment('是否推荐到封面');
            $table->integer('create_time')->unsigned()->default(0)->comment('创建时间');
            $table->integer('update_time')->unsigned()->default(0)->comment('修改时间');
        });
        //表注释
        DB::statement("ALTER TABLE `cy_goods` comment'商品表'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //回滚操作
        Schema::drop('cy_goods');
    }
}
