<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\TipsSimRepositoryEloquent as TipsSimRepository;
use App\Repositories\Eloquent\PermissionRepositoryEloquent as PermissionRepository;
use App\Repositories\Eloquent\AdminUserRepositoryEloquent  as AdminUserRepository;
use App\Repositories\Eloquent\ClassesRepositoryEloquent as ClassesRepository;
use App\Http\Controllers\Controller;

class TipsSimController extends Controller
{
    public $tipssim;
    public $permission;
    public $classes;
    public $adminUser;

    public function __construct(TipsSimRepository $tipssimRepository,PermissionRepository $permissionRepository,AdminUserRepository $adminUserRepository, ClassesRepository $classesRepository)
    {
        // $this->middleware('CheckPermission:tips');
        $this->tipssim = $tipssimRepository;
        $this->permission = $permissionRepository;
        $this->adminUser  = $adminUserRepository;
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
        $tipssim = $this->tipssim->getAll();

        return view('admin.tipssim.index', compact('tipssim', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->tipssim->createTipsSim($request->all());
        return redirect('admin/tipssim');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     * 编辑页面
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage. 更新
     * @param MenuRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     * 删除
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    /**
     * 接口获取信息
     */
    public function ajaxIndex(Request $request){
        $result = $this->tipssim->ajaxIndex($request);
        return response()->json($result,JSON_UNESCAPED_UNICODE);
    }


    /**
     * [addStaff description]
     * @param [type] $id [description]
     * @return  模板文件 [<description>]
     */
    public function info($id){

        $id = intval($id);
        if(!$id){
            abort('参数错误');
        }

        $busname=$this->tipssim->getBusName($id);
        $busid=$id;
        $tipstarget    = getTipsTarget();
        $paytype   = getPayType();
        $amount   = $this->tipssim->getAmount($id);
        $users = $this->tipssim->getStaff($id);
        return view('admin.tipssim.info', compact('busid','busname', 'users','tipstarget', 'paytype', 'amount'));
    }

}
