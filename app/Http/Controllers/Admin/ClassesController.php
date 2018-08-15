<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\BusinessesRepositoryEloquent as BusinessesRepository;
use App\Repositories\Eloquent\PermissionRepositoryEloquent as PermissionRepository;
use App\Repositories\Eloquent\AdminUserRepositoryEloquent  as AdminUserRepository;
use App\Repositories\Eloquent\ClassesRepositoryEloquent as ClassesRepository;
use App\Http\Controllers\Controller;

class ClassesController extends Controller
{
    public $businesses;
    public $permission;
    public $classes;

    public function __construct(BusinessesRepository $businessesRepository,PermissionRepository $permissionRepository,AdminUserRepository $adminUserRepository, classesRepository $ClassesRepository)
    {
        $this->middleware('CheckPermission:classes');
        $this->businesses   = $businessesRepository;
        $this->permission   = $permissionRepository;
        $this->adminuser    = $adminUserRepository;
        $this->classes      = $ClassesRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        $type = $type;
        switch ($type) {
            case 0:
            $data = "商户";
                break;
            case 1:
            $data = "商品类别";
                break;
            case 2:
            $data = "商品属性";
                break;
            case 3:
            $data = "员工";
                break;
        }
        // dd(auth('admin')->user()->id);
        $bid = 0;
        return view('admin.classes.index', compact('bid', 'type',"data"));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($bid = 0, $type = 0)
    {

        $bid            = intval($bid);
        $users          = $this->adminuser->getALlAdminUsers();
        //分类类型
        $class_type     = intval($type);
        $type = $class_type;
        switch ($type) {
            case 0:
                $data = "商户";
                break;
            case 1:
                $data = "商品类别";
                break;
            case 2:
                $data = "商品属性";
                break;
            case 3:
                $data = "员工";
                break;
        }

       //获取商家父级
        $condition      = 'class_type = '.$class_type.' and businesses_id = '.$bid;
        $classes_parent = $this->classes->getAll($condition, ['*'], false);
        return view('admin.classes.create',compact('users', 'bid', 'class_type', 'classes_parent','data'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $this->classes->createClasses($request->all());
        if($request->businesses_id){
            return redirect('admin/businesses/info/id/'.$request->businesses_id);
        }else{
            return redirect('admin/classes/type/'.$request->class_type);
        }

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

        $classes        = $this->classes->editViewData($id);
        $users          = $this->adminuser->getALlAdminUsers();

        $type = $classes['class_type'];
        switch ($type) {
            case 0:
                $data = "商户";
                break;
            case 1:
                $data = "商品类别";
                break;
            case 2:
                $data = "商品属性";
                break;
            case 3:
                $data = "员工";
                break;
        }
        //获取商家父级
        $condition      = 'class_type = '.$classes['class_type'].' and businesses_id = '.$classes['businesses_id'];
        $classes_parent = $this->classes->getAll($condition, ['*'], false);
        return view('admin.classes.edit',compact('classes', 'users', 'classes_parent','data'));
    }

    /**
     * Update the specified resource in storage. 更新
     * @param MenuRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $class_type = $request->class_type;
        $this->classes->updateClasses($request->all(),$id);
        if($request->all()['businesses_id'] > 0){
            return redirect('admin/businesses/info/id/'.$request->all()['businesses_id']);
        }else{
            return redirect('admin/classes/type/'.$class_type);
        }
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
                $re_data = $this->classes->delete($id);

                if($re_data){
                    flash('永久删除成功','success');
                }else{
                    flash('永久删除失败','error');
                }
                $re_url = 'admin/dash/classes';
                break;
            default:
                $arr['status'] = 9;//软删除
                $businesses_id       = $this->classes->find($id, ['businesses_id'])->businesses_id;  //查询 merchant_id
                $res = $this->classes->update($arr, $id);
                if ($res){
                    flash('删除成功','success');
                }else{
                    flash('删除失败','error');
                }
                $re_url = 'admin/businesses/info/id/'.$businesses_id;
                break;
        }

        return redirect($re_url);
    }


    /**
     * 接口获取信息
     */
    public function ajaxIndex(Request $request){
        $result = $this->classes->ajaxIndex($request);
        return response()->json($result,JSON_UNESCAPED_UNICODE);
    }

}
