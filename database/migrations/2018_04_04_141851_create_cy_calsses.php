<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCyCalsses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //餐饮系统类别表
        Schema::create('cy_classes', function(Blueprint $table){
            $table->increments('id')->unsigned()->comment('主键id');
            $table->string('name', 50)->comment('类别名称');
            $table->tinyInteger('class_type')->unsigned()->default(0)->comment('分类类型 默认为0大类');
            $table->integer('parent_id')->unsigned()->default(0)->comment('父id');
            $table->integer('businesses_id')->unsigned()->default(0)->comment('商户id 默认为0 是大分类');
            $table->tinyInteger('status')->unsigned()->default(0)->comment('分类状态 0 正常');
            $table->string('description', 255)->default('')->comment('分类描述');
            $table->integer('create_at')->unsigned()->default(0)->comment('创建时间');
            $table->integer('update_at')->unsigned()->default(0)->comment('更新时间');
            $table->string('other', 255)->default('')->comment('扩展字段');
        });
        DB::statement("ALTER TABLE `cy_classes` comment'餐饮系统类别表 可能是公共类'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //回滚操作
        Schema::drop('cy_classes');
    }
}
