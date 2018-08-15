<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\BusinessesRepositoryEloquent as BusinessesRepository;
use App\Repositories\Eloquent\TipsSettingRepositoryEloquent as TipsSettingRepository;
use App\Repositories\Eloquent\PermissionRepositoryEloquent as PermissionRepository;
use App\Repositories\Eloquent\AdminUserRepositoryEloquent  as AdminUserRepository;
use App\Repositories\Eloquent\ClassesRepositoryEloquent as ClassesRepository;
use App\Http\Controllers\Controller;

class TipsSettingController extends Controller
{
    public $businesses;
    public $tipssetting;
    public $permission;
    public $classes;

    public function __construct(BusinessesRepository $businessesRepository,TipsSettingRepository $tipssettingRepository,PermissionRepository $permissionRepository,AdminUserRepository $adminUserRepository, ClassesRepository $classesRepository)
    {
        // $this->middleware('CheckPermission:tipssetting');
        $this->businesses = $businessesRepository;
        $this->tipssetting = $tipssettingRepository;
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
//        $tipssetting = $this->tipssetting->getAll();
//
//        return view('admin.tipssetting.index', compact('tipssetting', 'tipstype'));


        return view('admin.tipssetting.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$tipssetting = $this->tipssetting->getAll();
        //获取商家
        $businesses_type = $this->businesses->getAll();

        $tipstype    = getsTipsType();
        $smailflag   = getsSmileFlag();
        return view('admin.tipssetting.create',compact('businesses_type', 'tipstype', 'smailflag'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|unique:cy_tips_setting',
        ]);
        $this->tipssetting->createTipsSetting($request->all());
        return redirect('admin/tipssetting');
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
        $tipssetting = $this->tipssetting->editViewData($id);
        //获取商家
        $businesses_type = $this->businesses->getAll();

        $businessesname=$this->tipssetting->getBusName($id);

        $tipstype    = getsTipsType();
        $smailflag   = getsSmileFlag();
        return view('admin.tipssetting.edit',compact('tipssetting', 'tipstype', 'smailflag', 'businesses_type','businessesname'));
    }

    /**
     * Update the specified resource in storage. 更新
     * @param MenuRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->tipssetting->updateTipsSetting($request->all(),$id);
        return redirect('admin/tipssetting');
    }

    /**
     * Remove the specified resource from storage.
     * 删除
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = $this->tipssetting->delete($id);
        if ($res){
            flash('商户打赏设置删除成功','success');
        }else{
            flash('商户打赏设置删除失败','error');
        }
        return redirect('admin/tipssetting');
    }

    /**
     * 接口获取信息
     */
    public function ajaxIndex(Request $request){
        $result = $this->tipssetting->ajaxIndex($request);
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
        $businesses = $this->tipssetting->find($id)->toArray();
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
        return view('admin.tipssetting.info', compact('id', 'tipssetting'));
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
        $res    = $this->tipssetting->update($update, $id);

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
