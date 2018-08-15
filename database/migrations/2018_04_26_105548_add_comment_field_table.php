<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommentFieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //评论数据表
        Schema::table('cy_comment', function (Blueprint $table) {
            $table->integer('users_id')->unsigned()->default(0)->comment('用户id');
            $table->integer('bus_id')->unsigned()->default(0)->comment('商户id');
            $table->integer('goods_id')->unsigned()->default(0)->comment('菜品id');
            $table->tinyInteger('detail_type')->unsigned()->default(0)->comment('评论详细类型 1外卖 2食堂');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('cy_comment', function ($table) {
            $table->dropColumn(['users_id', 'bus_id', 'goods_id','detail_type']);
        });
    }
}
