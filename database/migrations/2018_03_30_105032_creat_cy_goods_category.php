<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatCyGoodsCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //商品分类
        Schema::create('cy_goods_category', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('主键id');
            $table->integer('goods_id')->unsigned()->default(0)->comment(' 商品id');
            $table->string('name', 255)->default('')->comment('分类名称');
            $table->string('short_name', 255)->default('')->comment('分类简称');
            $table->integer('cate_img')->default(0)->comment('分类图标');
            $table->integer('parent_id')->unsigned()->default(0)->comment('父ID');
            $table->decimal('min_rate', 8, 2)->default(0.00)->comment('平台分成比例');
            $table->integer('sort')->unsigned()->default(0)->comment('排序');
            $table->string('create_ip', 255)->default('')->comment('创建ip');
            $table->string('update_ip', 255)->default('')->comment('修改ip');
            $table->integer('create_at')->unsigned()->default(0)->comment('创建时间');
            $table->integer('update_at')->unsigned()->default(0)->comment('更新时间');
            $table->string('other', 255)->default('')->comment('扩展字段');
        });

        DB::statement("ALTER TABLE `cy_goods_category` comment'商品分类'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //滚回操作
        Schema::drop('cy_goods_category');
    }
}
