<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;
use App\Repositories\Eloquent\FileRepositoryEloquent as FileRepository;
use App\Http\Controllers\Controller;

/*
 * jQuery File Upload Plugin PHP Class 7.1.4
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 *
 * add 文件处理
 */

class FileController extends Controller
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
    public function uploadFile(Request $request){
        $file= $request->file('file');

        if ($file->isValid()) {

            //获取文件的原文件名 包括扩展名
            $originname = $file->getClientOriginalName();

            //获取文件的扩展名
            $ext = $file->getClientOriginalExtension();

            //获取文件的类型
            $mime = $file->getClientMimeType();

            //获取文件的绝对路径，但是获取到的在本地不能打开
            $path = $file->getRealPath();

            //要保存的文件名 时间+扩展名
            $filename = date('Y-m-d-H-i-s') . '_' . uniqid() .'.'.$ext;
            //保存文件          配置文件存放文件的名字  ，文件名，路径
            $bool       = Storage::disk('public')->put($filename,file_get_contents($path));
            if($bool){
                $file_dir   = Config::get('filesystems.disks.public.root');
                $file_path  = $file_dir.'/'.$filename;
                $md5_code   = md5_file($file_path);
                $sha1_file  = sha1_file($file_path);
                $size       = Storage::disk('public')->size($filename);
                $relative_path = Config::get('filesystems.disks.public.root_relative');
                $url_path      = str_replace('/public', '', $relative_path).'/'.$filename;
                $file_arr['name'] = $originname;
                $file_arr['size'] = $size;
                $file_arr['ext']  = $ext;
                $file_arr['md5']  = $md5_code;
                $file_arr['sha1'] = $sha1_file;
                $file_arr['mime'] = $mime;
                $file_arr['savename']  = $filename;
                $file_arr['savepath']  = $relative_path;
                $file_arr['location']  = '';
                $file_arr['path']      = $url_path;
                $file_arr['abs_url']   = '';
                $file_arr['oss_path']  = '';
                $id = $this->fileM->createFile($file_arr);
                if($id){
                    return ['status' => 200,'data' => $id];
                }else{
                    return ['status' => 500, 'message' => '系统出错！'];
                }
            }else{
                return ['status' => 501, 'message' => '系统文件操作失败，请联系管理员！'];
            }
        }else{
            return ['status' => 300, 'message' => '上传文件不合法！'];
        }
    }

    /**
    * 返回可读性更好的文件尺寸
    */
    protected function human_filesize($bytes, $decimals = 2)
    {
        $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
        $factor = floor((strlen($bytes) - 1) / 3);

        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .@$size[$factor];
    }

}