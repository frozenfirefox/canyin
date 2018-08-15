<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldInStaff extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //修改字段
        Schema::table('cy_staff', function(Blueprint $table){
            $table->string('phone', 11)->default('')->comment('手机号')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //回滚
        Schema::table('cy_staff', function(Blueprint $table){
            $table->integer('phone')->unsigned()->default(0)->comment('手机号')->change();
        });
    }
}
