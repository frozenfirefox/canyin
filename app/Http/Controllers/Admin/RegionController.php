<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\RegionRepositoryEloquent as RegionRepository;
use App\Repositories\Eloquent\PermissionRepositoryEloquent as PermissionRepository;
use App\Repositories\Eloquent\AdminUserRepositoryEloquent  as AdminUserRepository;
use App\Http\Controllers\Controller;

class RegionController extends Controller
{

    public $region;
    public $permission;

    public function __construct(RegionRepository $regionRepository,PermissionRepository $permissionRepository,AdminUserRepository $adminUserRepository)
    {
        // $this->middleware('CheckPermission:businesses');
        $this->region     = $regionRepository;
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
        // $data = $this->region->getStreetByPid(3302);
        // dd($data);
        // $field = ['id','name','turnover','phone','address','user_id','create_time','updated_at'];
        // $businesses = $this->businesses->getAll($field);
        return view('admin.region.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr   = $this->region->arrLocation ();//调用数组
        $users = $this->adminuser->getALlAdminUsers();
        return view('admin.region.create',compact('users','arr'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->region->createRegion($request->all());
        return redirect('admin/Region');
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
        $region  = $this->region->editViewData($id);
        $users = $this->adminuser->getALlAdminUsers();
        $arr   = $this->region->arrLocation ();//调用数组
        return view('admin.region.edit',compact('Region', 'users','arr'));
    }

    /**
     * Update the specified resource in storage. 更新
     * @param MenuRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->region->updateRegion($request->all(),$id);
        return redirect('admin/Region');
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
                $region_info  = $this->region->find($id)->toArray();
                $re_data    = $this->region->delete($id);

                if($re_data){

                    $re = deleteRegion($region_info['path']);

                    flash('永久删除成功','success');
                }else{
                    flash('永久删除失败','error');
                }
                $re_url = 'admin/dash';
                break;
            default:
                $arr['status'] = 9;//软删除
                $res = $this->region->update($arr, $id);
                if ($res){
                    flash('消息删除成功','success');
                }else{
                    flash('消息删除失败','error');
                }
                $re_url = 'admin/Region';
                break;
        }

        return redirect($re_url);
    }

    /**
     * 接口获取信息
     */
    public function ajaxIndex(Request $request){
        $result = $this->region->ajaxIndex($request);
        return response()->json($result,JSON_UNESCAPED_UNICODE);
    }

    /**
     * 获取街道信息根据区id
     * @param [type] $id [description]
     */
    public function getStreet(Request $request){
        $data = $this->region->getStreetByPid($request->all()['pid']);
        return response()->json(['status' => 200, 'data' => $data], JSON_UNESCAPED_UNICODE);
    }

    public function RegionInfo($id){
        $id = intval($id);
        if(!$id){
            abort('参数错误');
        }
        $region =  $this->region->find($id)->toArray();
        $arr  =  $this->region->arrLocation ();//调用数组
        $region['location']     = $arr[$region['location']];
        $region['create_time']  = toDate($region['create_time'],'-',true);
        return view('admin.region.info', compact('id', 'Region'));
    }


}
