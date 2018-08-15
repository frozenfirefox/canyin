<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldGoodsAttrId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('cy_goods_attr', function(Blueprint $table){
            $table->string('goods_attr_id', 60)->default('')->change();
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
        Schema::table('cy_goods_attr', function(Blueprint $table){
            $table->integer('goods_attr_id')->unsigned()->default(0)->change();
        });
    }
}
