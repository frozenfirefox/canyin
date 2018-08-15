<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsMaterial2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //商户员工表
        Schema::create('cy_goods_material', function(Blueprint $table){
            $table->increments('id')->unsigned()->comment('主键id');
            $table->integer('ma_bus_id')->unsigned()->comment('商户id');
            $table->string('ma_material',250)->default('')->comment('材料名称');
            $table->decimal('ma_price',10,2)->default(0)->comment('材料单价');
            $table->integer('ma_material_num')->default(0)->comment('库存数量');
            $table->decimal('ma_amount',10,2)->default(0)->comment('材料总金额');
            $table->integer('created_at')->unsigned()->default(0)->comment('创建时间');
            $table->tinyInteger('ma_is_adequate')->unsigned()->default(0)->comment('是否充足（0正常1缺货）');
            $table->tinyInteger('ma_status')->default(0)->comment('是否删除（0正常1删除）');
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
        Schema::drop('cy_goods_material');
    }
}
