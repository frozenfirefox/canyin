<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\BusinessesRepositoryEloquent as BusinessesRepository;
use App\Repositories\Eloquent\PermissionRepositoryEloquent as PermissionRepository;
use App\Repositories\Eloquent\AdminUserRepositoryEloquent  as AdminUserRepository;
use App\Repositories\Eloquent\ClassesRepositoryEloquent as ClassesRepository;
use App\Http\Controllers\Controller;

class BusinessesController extends Controller
{
    public $businesses;
    public $permission;
    public $classes;

    public function __construct(BusinessesRepository $businessesRepository,PermissionRepository $permissionRepository,AdminUserRepository $adminUserRepository, ClassesRepository $classesRepository)
    {
        // $this->middleware('CheckPermission:businesses');
        $this->businesses = $businessesRepository;
        $this->permission = $permissionRepository;
        $this->adminuser  = $adminUserRepository;
        $this->classes    = $classesRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getdata    = getsBusStatus();
        if($getdata){
            unset($getdata[9]);
        }else{
            $getdata = [];
        }
        $status     = json_encode($getdata);
        $businesses = $this->businesses->getAll();
        return view('admin.businesses.index', compact('businesses', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $users      = $this->adminuser->getALlAdminUsers();
        //获取商户类型
        $classes    = $this->classes->getList('class_type = 0');
        //获取商家父级
        $condition  = 1;
        $businesses = $this->businesses->getAll($condition, ['*'], false);

        return view('admin.businesses.create',compact('classes', 'businesses'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->businesses->createBusinesses($request->all());
        return redirect('admin/businesses');
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

        $businesses = $this->businesses->editViewData($id);
        $users      = $this->adminuser->getALlAdminUsers();
        //获取商户类型
        $classes    = $this->classes->getList('class_type = 0');
        //获取商家父级
        $businesses_type = $this->businesses->getAll(1, ['*'], false);

        return view('admin.businesses.edit',compact('businesses', 'users', 'classes', 'businesses_type'));
    }

    /**
     * Update the specified resource in storage. 更新
     * @param MenuRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->businesses->updateBusinesses($request->all(),$id);
        return redirect('admin/businesses');
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
                $re_data = $this->businesses->delete($id);
                if($re_data){
                    flash('永久删除成功','success');
                }else{
                    flash('永久删除失败','error');
                }
                $re_url = 'admin/dash/bus';
                break;
            default:
                $arr['status'] = 9;//软删除
                $res = $this->businesses->update($arr, $id);
                if ($res){
                    flash('商户删除成功','success');
                }else{
                    flash('商户删除失败','error');
                }
                $re_url = 'admin/businesses';
                break;
        }

        return redirect($re_url);
    }

    /**
     * 接口获取信息
     */
    public function ajaxIndex(Request $request){
        $result = $this->businesses->ajaxIndex($request);
        return response()->json($result,JSON_UNESCAPED_UNICODE);
    }

    /**
     * [addStaff description]
     * @param [type] $id [description]
     * @return  模板文件 [<description>]
     */
    public function info($id){
        //todo 添加员工
        $id = intval($id);
        if(!$id){
            abort('参数错误');
        }
        $businesses = $this->businesses->find($id)->toArray();
        $businesses['tag_name'] = '';
        if($businesses['tag']){
            $arr_tag = explode(',', $businesses['tag']);
            foreach ($arr_tag as $value) {
                $middle_data = $this->classes->find($value)->toArray();
                if($businesses['tag_name']){
                    $businesses['tag_name'] .= ', '.$middle_data['name'];
                }else{
                    $businesses['tag_name'] .= $middle_data['name'];
                }
            }
        }
        //获取用户
        $user = $this->adminuser->find($businesses['user_id'])->toArray();
        $businesses['user_name']    =  ($user)?$user['name']:'';//获取用户名
        $businesses['create_time']  = toDate($businesses['create_time'], '-', true);
        $businesses['update_at']    = toDate($businesses['update_at'], '-', true);
        //这里为商户分类
        $class_type = 1;
        return view('admin.businesses.info', compact('id', 'businesses', 'class_type'));
    }

    /**
     * 更新单字段接口
     * @param  $id int [<description>]
     * @param  $update array [<description>]
     * @return $return array [<description>]
     */
    public function updateSingle(Request $request){

        $id     = $request->all()['id'];
        $update = $request->all()['update'];//软删除
        $res    = $this->businesses->update($update, $id);

        $result = [];
        if($id && $update && $res){
            $result = [
                'status' => 200,
                'message'=> '更新成功！'
            ];
        }else{
            $result = [
                'status' => 500,
                'mesage' => '信息错误！'
            ];
        }

        return response()->json($result,JSON_UNESCAPED_UNICODE);
    }
}
