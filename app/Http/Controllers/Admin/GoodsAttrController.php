<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\BusinessesRepositoryEloquent as BusinessesRepository;
use App\Repositories\Eloquent\PermissionRepositoryEloquent as PermissionRepository;
use App\Repositories\Eloquent\AdminUserRepositoryEloquent  as AdminUserRepository;
use App\Repositories\Eloquent\GoodsAttrRepositoryEloquent  as GoodsAttrRepository;
use App\Repositories\Eloquent\ClassesRepositoryEloquent    as ClassesRepository;
use App\Http\Controllers\Controller;

class GoodsAttrController extends Controller
{
    public $businesses;
    public $permission;
    public $goodsattr;

    public function __construct(
        BusinessesRepository $businessesRepository,
        PermissionRepository $permissionRepository,
        AdminUserRepository  $adminUserRepository,
        GoodsAttrRepository  $goodsAttrRepository,
        ClassesRepository    $classesRepository
    )
    {
        // $this->middleware('CheckPermission:businesses');
        $this->businesses = $businessesRepository;
        $this->permission = $permissionRepository;
        $this->adminuser  = $adminUserRepository;
        $this->goodsattr  = $goodsAttrRepository;
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
        $bid = 0;
        return view('admin.GoodsAttr.index', compact('bid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($bid = 0)
    {
        $bid     = intval($bid);
        $classes = $this->classes->getList(' businesses_id = 0 and class_type = 2');
        return view('admin.GoodsAttr.create',compact('users', 'bid', 'classes'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->goodsattr->createGoodsAttr($request->all());
        if($request->businesses_id){
            return redirect('admin/businesses/info/id/'.$request->businesses_id);
        }else{
            return redirect('admin/GoodsAttr');
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
        $goodsattr = $this->goodsattr->editViewData($id);
        $classes   = $this->classes->getList(' businesses_id = 0 and class_type = 2');
        return view('admin.goodsattr.edit',compact('goodsattr', 'classes'));
    }

    /**
     * Update the specified resource in storage. 更新
     * @param MenuRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->goodsattr->updateGoodsAttr($request->all(),$id);
        if($request->all()['businesses_id'] > 0){
            return redirect('admin/businesses/info/id/'.$request->all()['businesses_id']);
        }else{
            return redirect('admin/goodsattr');
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
                $re_data = $this->goodsattr->delete($id);

                if($re_data){
                    flash('永久删除成功','success');
                }else{
                    flash('永久删除失败','error');
                }
                $re_url = 'admin/dash/gattr';
                break;
            default:
                $arr['status'] = 9;//软删除
                $businesses_id       = $this->goodsattr->find($id, ['businesses_id'])->businesses_id;  //查询 merchant_id
                $res = $this->goodsattr->update($arr, $id);
                if ($res){
                    flash('删除成功','success');
                }else{
                    flash('删除失败','error');
                }
                $re_url = 'admin/businesses/info/id/'.$businesses_id;//admin/businesses/info/id/3
                break;
        }

        return redirect($re_url);
    }


    /**
     * 接口获取信息
     */
    public function ajaxIndex(Request $request){
        $result = $this->goodsattr->ajaxIndex($request);
        return response()->json($result,JSON_UNESCAPED_UNICODE);
    }

}
