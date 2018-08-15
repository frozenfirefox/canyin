<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableComment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //评论表
        Schema::create('cy_comment', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->integer('user1_id')->unsigned()->comment('评论者');
            $table->integer('user2_id')->unsigned()->default(0)->comment('@的人');
            $table->integer('pid')->unsigned()->default(0)->comment('父id');
            $table->string('content', 255)->comment('评论内容');
            $table->integer('module_id')->unsigned()->comment('评论信息 id');
            $table->tinyInteger('type')->unsigned()->default(0)->comment('0：产品评论 其他待定');
            $table->string('index', 255)->default('')->comment('这个预计是要做一个索引 /25/56/ 方便寻找父和子');
            $table->integer('create_at')->comment('创建时间');
            $table->integer('update_at')->default(0)->comment('修改时间');
            $table->tinyInteger('status')->default(0)->unsigned()->comment('状态 ： 0为正常 9为删除');
        });
        //表注释
        DB::statement("ALTER TABLE `cy_comment` comment'评论表'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('cy_comment');
    }
}
