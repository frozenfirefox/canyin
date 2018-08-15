<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\GoodsCategoryRepositoryEloquent as GoodsCategoryRepository;
use App\Repositories\Eloquent\PermissionRepositoryEloquent as PermissionRepository;
use App\Repositories\Eloquent\AdminUserRepositoryEloquent  as AdminUserRepository;
use App\Http\Controllers\Controller;

class GoodsCateController extends Controller
{
    public $goodscategory;
    public $permission;

    public function __construct(GoodsCategoryRepository $goodscategoryRepository,PermissionRepository $permissionRepository,AdminUserRepository $adminUserRepository)
    {
        // $this->middleware('CheckPermission:businesses');
        $this->goodscategory   = $goodscategoryRepository;
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
//        $field = ['*'];
//        $ticket = $this->ticket->getAll($field);
        return view('admin.goodscategory.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = $this->adminuser->getALlAdminUsers();
        return view('admin.goodscategory.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->goodscategory->createGoodsCategory($request->all());
        return redirect('admin/goodscategory');
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
        $goodscategory = $this->goodscategory->editViewData($id);
        $goodscategory['id'] = $id;
        $users   = $this->adminuser->getALlAdminUsers();
        return view('admin.goodscategory.edit',compact('goodscategory', 'users'));
    }

    /**
     * Update the specified resource in storage. 更新
     * @param MenuRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->goodscategory->updateGoodsCategory($request->all(),$id);
        return redirect('admin/goodscategory');
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
        $res = $this->goodscategory->update($arr, $id);
        if ($res){
            flash('商品类别删除成功','success');
        }else{
            flash('商品类别删除失败','error');
        }
        return redirect('admin/goodscategory');
    }

    /**
     * 接口获取信息
     */
    public function ajaxIndex(Request $request){
        $result = $this->goodscategory->ajaxIndex($request);
        return response()->json($result,JSON_UNESCAPED_UNICODE);
    }

    /**
     * [addStaff description]
     * @param [type] $id [description]
     * @return  模板文件 [<description>]
     */
    public function Info($id){

        $id = intval($id);
        if(!$id){
            abort('参数错误');
        }

        $goodscategory = $this->goodscategory->find($id)->toArray();

        $goodscategory['create_at'] = toDate($goodscategory['create_at'],'-',true);
        $goodscategory['update_at']   = toDate($goodscategory['update_at'],'-',true);
        return view('admin.goodscategory.info', compact('id', 'goodscategory'));
    }
}
