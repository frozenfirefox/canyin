<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldInCyBusinesses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //添加字段
        Schema::table('cy_businesses', function(Blueprint $table){
            $table->string('tag', 255)->default('')->after('name')->comment('商家标签 类似于商家分类');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //回滚字段
        Schema::table('cy_businesses', function(Blueprint $table){
            $table->dropColumn('tag');
        });
    }
}
