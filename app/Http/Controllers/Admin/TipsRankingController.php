<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\TipsRankingRepositoryEloquent as TipsRankingRepository;
use App\Repositories\Eloquent\PermissionRepositoryEloquent as PermissionRepository;
use App\Repositories\Eloquent\AdminUserRepositoryEloquent  as AdminUserRepository;
use App\Repositories\Eloquent\ClassesRepositoryEloquent as ClassesRepository;
use App\Http\Controllers\Controller;

class TipsRankingController extends Controller
{
    public $tipsranking;
    public $permission;
    public $classes;

    public function __construct(TipsRankingRepository $tipsrankingRepository,PermissionRepository $permissionRepository,AdminUserRepository $adminUserRepository, ClassesRepository $classesRepository)
    {
        // $this->middleware('CheckPermission:tips');
        $this->tipsranking = $tipsrankingRepository;
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
        $tipsranking = $this->tipsranking->getAll();

        return view('admin.tipsranking.index', compact('tipsranking', 'status'));
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

        $result = $this->tipsranking->ajaxIndex($request);
        return response()->json($result,JSON_UNESCAPED_UNICODE);
    }

    public function ajaxtips(Request $request){

        $ctype=$request->input('ctype', 0);
        switch ($ctype)
        {
            case 3:
                $result = $this->tipsranking->ajax_waiter($request);
                break;
            case 4:
                $result = $this->tipsranking->ajax_chef($request);
                break;
            case 1:
                $result = $this->tipsranking->ajax_goods($request);
                break;
            default:
                $result = $this->tipsranking->ajax_waiter($request);
                break;
        }
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
//        $tipsranking_waiter  = $this->tipsranking->getTipsRanking_waiter($id);
//
//        $tipsranking_chef  = $this->tipsranking->getTipsRanking_chef($id);
//
//        $tipsranking_goods  = $this->tipsranking->getTipsRanking_goods($id);

        $busname=$this->tipsranking->getBusName($id);
        $busid=$id;

        return view('admin.tipsranking.info', compact('busid','busname'));
    }

}
