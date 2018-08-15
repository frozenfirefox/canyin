<?php

namespace App\Http\Controllers\Test;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;
use App\Repositories\Eloquent\FileRepositoryEloquent as FileRepository;
use App\Http\Controllers\Controller;
use QrCode;
use App\Jobs\SendReminderEmail;
use Carbon\Carbon;

/*
 * 这是一个测试文件
 */

class TestController extends Controller
{

    public $fileM;

    public function __construct(FileRepository $fileRepository)
    {
        $this->fileM = $fileRepository;
    }

    /**
     * 上传图片的函数
     * @return [type] [description]
     */
    public function index(Request $request){
        if(!file_exists(public_path('qrcodes')))
            mkdir(public_path('qrcodes'));
        QrCode::format('png')->size(100)->color(255,0,255)->generate($request->url(), public_path('qrcodes/qrcode.png'));
        $path = 'http://'.$_SERVER['HTTP_HOST'].'/qrcodes/qrcode.png';
        return view('test.upload_file', compact('path'));
    }

    /**
     * vue的简单应用
     */
    public function vue(){
        return view('test.vue');
    }

    /**
     * viewer的使用简单介绍
     */
    public function viewer(){

        /*******  事务使用************/
        DB::beginTransaction();
        try{
            $result = DB::table('cy_file')->insert(['name' => '测试']);
            if ($result) {
                /**
                 * Exception类接收的参数
                 * $message = "", $code = 0, Exception $previous = null
                 */
                throw new \Exception("插入失败啊！");
            }
            $result2 = DB::table('cy_file')->insert(['name' => '我好啊']);
            if (!$result2) {
                throw new \Exception("2");
            }
            DB::commit();
        } catch (\Exception $e){
            DB::rollback();//事务回滚
            echo $e->getMessage();
            echo $e->getCode();
        }
        /*******  事务使用************/

        // return view('test.viewer');
    }


    /**
     * queue 队列测试
     */
    public function sendEmail(){
        // 表示一分钟后执行任务
        $job = (new SendReminderEmail(23))->delay(5);
        dispatch($job);
    }
}