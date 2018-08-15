<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCyStaff extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //商户员工表
        Schema::create('cy_staff', function(Blueprint $table){
            $table->increments('id')->unsigned()->comment('主键id');
            $table->integer('user_id')->unsigned()->comment('用户Id');
            $table->integer('phone')->unsigned()->comment('手机号');
            $table->integer('businesses_id')->unsigned()->comment('商户id');
            $table->tinyInteger('position')->unsigned()->default(0)->comment('员工职位');
            $table->integer('parent_id')->unsigned()->default(0)->comment('父id  0 为顶级员工');
            $table->tinyInteger('status')->unsigned()->default(0)->comment('员工状态 0 正常 9为删除');
            $table->text('description')->default('')->comment('员工描述');
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
        Schema::drop('cy_staff');
    }
}
