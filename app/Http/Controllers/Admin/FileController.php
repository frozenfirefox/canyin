<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\FileRepositoryEloquent as FileRepository;
use App\Repositories\Eloquent\PermissionRepositoryEloquent as PermissionRepository;
use App\Repositories\Eloquent\AdminUserRepositoryEloquent  as AdminUserRepository;
use App\Http\Controllers\Controller;

class FileController extends Controller
{

    public $file;
    public $permission;

    public function __construct(FileRepository $fileRepository,PermissionRepository $permissionRepository,AdminUserRepository $adminUserRepository)
    {
        // $this->middleware('CheckPermission:businesses');
        $this->file       = $fileRepository;
        $this->permission = $permissionRepository;
        $this->adminuser  = $adminUserRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $field = ['id','name','turnover','phone','address','user_id','create_time','updated_at'];
        // $businesses = $this->businesses->getAll($field);
        return view('admin.file.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr   = $this->file->arrLocation ();//调用数组
        $users = $this->adminuser->getALlAdminUsers();
        return view('admin.file.create',compact('users','arr'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->file->createFile($request->all());
        return redirect('admin/file');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * 编辑页面
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $file  = $this->file->editViewData($id);
        $users = $this->adminuser->getALlAdminUsers();
        $arr   = $this->file->arrLocation ();//调用数组
        return view('admin.file.edit',compact('file', 'users','arr'));
    }

    /**
     * Update the specified resource in storage. 更新
     * @param MenuRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->file->updateFile($request->all(),$id);
        return redirect('admin/file');
    }

    /**
     * Remove the specified resource from storage.
     * 删除
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $data = $request->all()['is_dash'];
        switch ($data) {
            case 1:
                $file_info  = $this->file->find($id)->toArray();
                $re_data    = $this->file->delete($id);

                if($re_data){

                    $re = deleteFile($file_info['path']);

                    flash('永久删除成功','success');
                }else{
                    flash('永久删除失败','error');
                }
                $re_url = 'admin/dash';
                break;
            default:
                $arr['status'] = 9;//软删除
                $res = $this->file->update($arr, $id);
                if ($res){
                    flash('消息删除成功','success');
                }else{
                    flash('消息删除失败','error');
                }
                $re_url = 'admin/file';
                break;
        }

        return redirect($re_url);
    }

    /**
     * 接口获取信息
     */
    public function ajaxIndex(Request $request){
        $result = $this->file->ajaxIndex($request);
        return response()->json($result,JSON_UNESCAPED_UNICODE);
    }


    public function fileInfo($id){
        $id = intval($id);
        if(!$id){
            abort('参数错误');
        }
        $file =  $this->file->find($id)->toArray();
        $arr  =  $this->file->arrLocation ();//调用数组
        $file['location']     = $arr[$file['location']];
        $file['create_time']  = toDate($file['create_time'],'-',true);
        return view('admin.file.info', compact('id', 'file'));
    }


}
