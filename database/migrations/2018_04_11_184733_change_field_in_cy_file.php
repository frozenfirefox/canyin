<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldInCyFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //更改订单表
        Schema::table('cy_file', function(Blueprint $table){
            $table->dropIndex('cy_file_name_unique');
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
        Schema::table('cy_file', function(Blueprint $table){
            $table->unique('name');
        });
    }
}
