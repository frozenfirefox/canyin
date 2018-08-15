<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\UserticketRepositoryEloquent as UserticketRepository;
use App\Repositories\Eloquent\PermissionRepositoryEloquent as PermissionRepository;
use App\Repositories\Eloquent\AdminUserRepositoryEloquent  as AdminUserRepository;
use App\Http\Controllers\Controller;

class UserticketController extends Controller
{
    public $userticket;
    public $permission;

    public function __construct(UserticketRepository $userticketRepository,PermissionRepository $permissionRepository,AdminUserRepository $adminUserRepository)
    {
        // $this->middleware('CheckPermission:businesses');
        $this->userticket = $userticketRepository;
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
        return view('admin.userticket.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr = $this->userticket->arrStatus();
        $users = $this->adminuser->getALlAdminUsers();
        return view('admin.userticket.create',compact('users','arr'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->userticket->createUserticket($request->all());
        return redirect('admin/userticket');
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
        $arr        = $this->userticket->arrStatus();
        $userticket = $this->userticket->editViewData($id);
        $users      = $this->adminuser->getALlAdminUsers();
        return view('admin.userticket.edit',compact('userticket', 'users','arr'));
    }

    /**
     * Update the specified resource in storage. 更新
     * @param MenuRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->userticket->updateUserticket($request->all(),$id);
        return redirect('admin/userticket');
    }

    /**
     * Remove the specified resource from storage.
     * 删除
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $arr['status'] = 9;//软删除
        $res = $this->userticket->update($arr, $id);
        if ($res){
            flash('消息删除成功','success');
        }else{
            flash('消息删除失败','error');
        }
        return redirect('admin/userticket');
    }

    /**
     * 接口获取信息
     */
    public function ajaxIndex(Request $request){

        $result = $this->userticket->ajaxIndex($request);
        return response()->json($result,JSON_UNESCAPED_UNICODE);
    }


    public function userticketInfo($id){
        $id = intval($id);
        if(!$id){
            abort('参数错误');
        }
        $userticket = $this->userticket->find($id)->toArray();
        $arr = $this->userticket->arrStatus();
        $userticket['status']      = $arr[$userticket['status']];
        $userticket['create_time'] = toDate($userticket['create_time'],'-',true);
        $userticket['update_at']   = toDate($userticket['update_at'],'-',true);
        return view('admin.userticket.info', compact('id', 'userticket'));
    }


}
