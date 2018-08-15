<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCyUserTicket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //user ticket
        Schema::create('cy_user_ticket', function(Blueprint $table){
            $table->increments('id')->unsigned()->comment('主键id');
            $table->string('ticket_id', 50)->comment('不能为空 这是ticketId 这里想法是要用UUID');
            $table->integer('user_id')->unsigned()->comment('用户id');
            $table->tinyInteger('status')->unsigned()->default(0)->comment('状态0未使用 1已使用');
            $table->integer('create_time')->unsigned()->default(0)->comment('领取时间');
            $table->integer('update_at')->unsigned()->default(0)->comment('更新时间');
            $table->string('other', 255)->default('')->comment('扩展字段');
        });
        DB::statement("ALTER TABLE `cy_ticket` comment'餐饮平台个人优惠券表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //回滚操作
        Schema::drop('cy_user_ticket');
    }
}
