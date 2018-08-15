<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDbFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for storing roles
        Schema::create('cy_file', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->string('name', 35)->unique()->comment('文件原名');
            $table->integer('size')->unsigned()->default(0)->comment('文件尺寸');
            $table->string('ext', 9)->default('')->comment('扩展名');
            $table->string('md5', 32)->default('')->comment('文件md5');
            $table->string('sha1', 40)->default('')->comment('文件sha1');
            $table->string('mime', 40)->default('')->comment('文件mine类型');
            $table->string('savename', 25)->default('')->comment('保存文件名');
            $table->string('savepath', 45)->default('')->comment('保存路径');
            $table->tinyInteger('location')->default(0)->comment('文件保存位置 0本地');
            $table->string('path', 60)->default('')->comment('全相对路径');
            $table->string('abs_url', 105)->default('')->comment('绝对地址');
            $table->integer('create_time')->default(0)->unsigned()->comment('创建时间');
            $table->tinyInteger('status')->default(1)->unsigned()->comment('状态');
            $table->string('oss_path', 255)->default('')->comment('oss服务器路径');
        });
        //表注释
        DB::statement("ALTER TABLE `cy_file` comment'文件集中管理表'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('cy_file');
    }
}
