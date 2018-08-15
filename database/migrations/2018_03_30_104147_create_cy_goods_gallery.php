<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCyGoodsGallery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //商品相册表
        Schema::create('cy_goods_gallery', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('主键id');
            $table->integer('goods_id')->unsigned()->default(0)->comment('商品id');
            $table->string('goods_pictures', 255)->default('')->comment('图片用,隔开');
            $table->integer('sort')->default(0)->comment('商品图片显示顺序');
            $table->integer('create_at')->unsigned()->default(0)->comment('创建时间');
            $table->integer('update_at')->unsigned()->default(0)->comment('更新时间');
            $table->string('other', 255)->default('')->comment('扩展字段');
        });

        DB::statement("ALTER TABLE `cy_goods_gallery` comment'商品相册'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //滚回操作
        Schema::drop('cy_goods_gallery');
    }
}
