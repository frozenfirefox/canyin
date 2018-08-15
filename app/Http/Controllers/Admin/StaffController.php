<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\BusinessesRepositoryEloquent as BusinessesRepository;
use App\Repositories\Eloquent\PermissionRepositoryEloquent as PermissionRepository;
use App\Repositories\Eloquent\AdminUserRepositoryEloquent  as AdminUserRepository;
use App\Repositories\Eloquent\ClassesRepositoryEloquent  as ClassesRepository;
use App\Repositories\Eloquent\StaffRepositoryEloquent as StaffRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    public $businesses;
    public $permission;
    public $staff;
    public $classes;

    public function __construct(BusinessesRepository $businessesRepository,PermissionRepository $permissionRepository,AdminUserRepository $adminUserRepository, StaffRepository $StaffRepository,ClassesRepository $classesRepository)
    {
        // $this->middleware('CheckPermission:businesses');
        $this->businesses = $businessesRepository;
        $this->permission = $permissionRepository;
        $this->adminuser  = $adminUserRepository;
        $this->staff      = $StaffRepository;
        $this->classes    = $classesRepository;
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
        return view('admin.businesses.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($bid)
    {
        $classes   = $this->classes->getList(' businesses_id = 0 and class_type = 3');
        $staff     = $this->staff->getList(' businesses_id',$bid);//$bid=10
        $user_name = [];
        foreach($staff as $k => $v){
            $user_name[]   = $this->adminuser->getAdminUsers($v['user_id']);
        }
        $bid = intval($bid);
        if(!$bid){
            abort(500 , '参数错误 商户id错误');
        }
        $users = $this->adminuser->getALlAdminUsers();
        return view('admin.staff.create',compact('users', 'bid','classes','user_name'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->staff->createStaff($request->all());
        return redirect('admin/businesses/info/id/'.$request->businesses_id);
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
        $classes    = $this->classes->getList(' businesses_id = 0 and class_type = 3');
        $staff      = $this->staff->editViewData($id);
        $staff_id   = $this->staff->getList('businesses_id',$staff['businesses_id']);
        $user_name = [];
        foreach($staff_id as $k => $v){
            $user_name[]   = $this->adminuser->getAdminUsers($v['user_id']);
        }
        $users = $this->adminuser->getALlAdminUsers();
        return view('admin.staff.edit',compact('staff', 'users','classes','user_name'));
    }

    /**
     * Update the specified resource in storage. 更新
     * @param MenuRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->staff->updateStaff($request->all(),$id);
        return redirect('admin/businesses/info/id/'.$request->all()['businesses_id']);
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
                $re_data = $this->staff->delete($id);
                if($re_data){
                    flash('永久删除成功','success');
                }else{
                    flash('永久删除失败','error');
                }
                $re_url = 'admin/dash/staff';
                break;
            default:
                $arr['status'] = 9;//软删除
                $businesses_id       = $this->staff->find($id, ['businesses_id'])->businesses_id;  //查询 merchant_id
                $res = $this->staff->update($arr, $id);
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
        $result = $this->staff->ajaxIndex($request);
        return response()->json($result,JSON_UNESCAPED_UNICODE);
    }

    /**
     * [addStaff description]
     * @param [type] $id [description]
     * @return  模板文件 [<description>]
     */
    public function businessesInfo($id){
        //todo 添加员工
        return view('admin.businesses.info');
    }
}
