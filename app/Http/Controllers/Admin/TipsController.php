<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\BusinessesRepositoryEloquent as BusinessesRepository;
use App\Repositories\Eloquent\TipsRepositoryEloquent as TipsRepository;
use App\Repositories\Eloquent\PermissionRepositoryEloquent as PermissionRepository;
use App\Repositories\Eloquent\AdminUserRepositoryEloquent  as AdminUserRepository;
use App\Repositories\Eloquent\ClassesRepositoryEloquent as ClassesRepository;
use App\Http\Controllers\Controller;

class TipsController extends Controller
{
    public $businesses;
    public $tips;
    public $permission;
    public $classes;

    public function __construct(BusinessesRepository $businessesRepository,TipsRepository $tipsRepository,PermissionRepository $permissionRepository,AdminUserRepository $adminUserRepository, ClassesRepository $classesRepository)
    {
        // $this->middleware('CheckPermission:tips');
        $this->businesses = $businessesRepository;
        $this->tips = $tipsRepository;
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
//        $gettipstype    = getsTipsType();
//        if($gettipstype){
//            unset($gettipstype[0]);
//        }else{
//            $gettipstype = [];
//        }
//        $tipstype     = json_encode($gettipstype);
//        //$businesses = $this->businesses->getAll();
//        $tips = $this->tips->getAll();
//
//        return view('admin.tips.index', compact('tips', 'tipstype'));

        return view('admin.tips.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        //获取商家
//        $businesses_type = $this->businesses->getAll();
//        return view('admin.tips.create',compact('businesses_type'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
//        $this->tips->createTips($request->all());
        return redirect('admin/tips');
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
//        $tips = $this->tips->editViewData($id);
//        //获取商家
//        $businesses_type = $this->businesses->getAll();
//        $businessesname=$this->tips->getBusName($id);
//        return view('admin.tips.edit',compact('tips', 'businesses_type','businessesname'));
    }

    /**
     * Update the specified resource in storage. 更新
     * @param MenuRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
//        $this->tips->updateTips($request->all(),$id);
        return redirect('admin/tips');
    }

    /**
     * Remove the specified resource from storage.
     * 删除
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $arr['ct_status'] = 9;//软删除
        $res = $this->tips->update($arr, $id);
        if ($res){
            flash('打赏删除成功','success');
        }else{
            flash('打赏删除失败','error');
        }
        return redirect('admin/tips');
    }

    /**
     * 接口获取信息
     */
    public function ajaxIndex(Request $request){
        $result = $this->tips->ajaxIndex($request);
        return response()->json($result,JSON_UNESCAPED_UNICODE);
    }

    /**
     * [addStaff description]
     * @param [type] $id [description]
     * @return  模板文件 [<description>]
     */
    public function info($id){

        $tips = $this->tips->find($id)->toArray();


        $tips['ct_create_time']  = toDate($tips['ct_create_time'], '-', true);

        $tipstarget = getTipsTarget();
        $paytype = getPayType();
        $tipsstatus = getTipsStatus();
        if(!empty($tips)) {
            $tips['ct_target']=$tipstarget[$tips['ct_target']]?$tipstarget[$tips['ct_target']]:'';
            $tips['ct_paytype']=$paytype[$tips['ct_paytype']]?$paytype[$tips['ct_paytype']]:'';
            $tips['ct_status']=$tipsstatus[$tips['ct_status']]?$tipsstatus[$tips['ct_status']]:'';
            $tips['ct_bus_id'] =  $this->tips->getBusName($tips['ct_bus_id']);;//获取商户名
            $tips['ct_tuser_id'] =  $this->tips->getUserName($tips['ct_tuser_id']);;//获取用户名
        }
        return view('admin.tips.info', compact('id', 'tips'));
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
        $res    = $this->tips->update($update, $id);

        $result = [];
        if($id && $update && $res){
            $result = [
                'status' => 200,
                'message'=> '更新成功！'
            ];
        }else{
            $result = [
                'status' => 500,
                'message' => '信息错误！'
            ];
        }

        return response()->json($result,JSON_UNESCAPED_UNICODE);
    }
}
