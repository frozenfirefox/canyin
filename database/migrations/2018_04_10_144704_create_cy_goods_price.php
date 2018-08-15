<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCyGoodsPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //商品价格表
        Schema::create('cy_goods_price', function(Blueprint $table){
            $table->increments('id')->unsigned()->comment('主键id');
            $table->integer('goods_id')->unsigned()->comment('商品id');
            $table->string('goods_specification', 255)->comment('规格');
            $table->decimal('settlement_price', 10, 2)->default(0.00)->comment('结算价格');
            $table->decimal('shop_price', 10, 2)->default('0.00')->comment('销售价格');
            $table->decimal('market_price', 10, 2)->default('0.00')->comment('市场价');
            $table->tinyInteger('goods_unit_type')->unsigned()->comment('商品计件方式 1为重量，2为体积,3为件');
            $table->decimal('goods_weight', 10, 3)->comment('商品重量单位KG或体积单位L ');
            $table->string('goods_img', 255)->default('')->comment('产品相片 多张用 , 隔开');
            $table->tinyInteger('status')->unsigned()->default(0)->comment('0正常.其他待定.9为删除');
            $table->decimal('wy_price', 10, 2)->comment('无优价');
            $table->decimal('yx_price', 10, 2)->comment('优享价');
            $table->integer('integral')->comment('积分价格');
            $table->integer('discount')->comment('红券使用比例(单位%)');
            $table->integer('red_rurn_integral')->comment('红券返积分');
            $table->integer('yellow_discount')->comment('黄券使用比例 (%)');
            $table->integer('yellow_return_integral')->comment('黄券返积分');
            $table->integer('blue_discount')->comment('蓝券使用比例(%)');
            $table->integer('create_at')->unsigned()->default(0)->comment('创建时间');
            $table->integer('update_at')->unsigned()->default(0)->comment('更新时间');
            $table->string('other', 255)->default('')->comment('扩展字段');
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
        Schema::drop('cy_goods_price');
    }
}
