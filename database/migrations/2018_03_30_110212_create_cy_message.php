<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCyMessage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //餐饮网消息
        Schema::create('cy_message', function(Blueprint $table){
            $table->increments('id')->unsigned()->comment('主键id');
            $table->integer('user_id')->unsigned()->default(0)->comment('用户id 如果为0全部用户');
            $table->integer('msg_type')->unsigned()->default(0)->comment('消息类型 0 系统消息 1 订单消息表 扩充后注释说明');
            $table->string('title', 255)->comment('消息标题');
            $table->text('context')->comment('消息内容');
            $table->tinyInteger('status')->unsigned()->default(0)->comment('0 为正常 其他自行设定');
            $table->integer('create_at')->unsigned()->default(0)->comment('创建时间');
            $table->integer('update_at')->unsigned()->default(0)->comment('更新时间');
            $table->string('other', 255)->default('')->comment('扩展字段');
        });
        DB::statement("ALTER TABLE `cy_message` comment'餐饮平台消息表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //回滚操作
        Schema::drop('cy_message');
    }
}
