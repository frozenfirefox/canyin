<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\ProductCategoryRepositoryEloquent as ProductCategoryRepository;
use App\Repositories\Eloquent\PermissionRepositoryEloquent as PermissionRepository;
use App\Repositories\Eloquent\AdminUserRepositoryEloquent  as AdminUserRepository;
use App\Http\Controllers\Controller;

class ProductCateController extends Controller
{
    public $productcategory;
    public $permission;

    public function __construct(ProductCategoryRepository $productcategoryRepository,PermissionRepository $permissionRepository,AdminUserRepository $adminUserRepository)
    {
        // $this->middleware('CheckPermission:businesses');
        $this->productcategory   = $productcategoryRepository;
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
        return view('admin.productcategory.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users = $this->adminuser->getALlAdminUsers();
        return view('admin.productcategory.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->productcategory->createGoodsCategory($request->all());
        return redirect('admin/productcategory');
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
        $productcategory = $this->productcategory->editViewData($id);
//        dd($productcategory);
        $productcategory['id'] = $id;
        $users   = $this->adminuser->getALlAdminUsers();
        return view('admin.productcategory.edit',compact('productcategory', 'users'));
    }

    /**
     * Update the specified resource in storage. 更新
     * @param MenuRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->productcategory->updateGoodsCategory($request->all(),$id);
        return redirect('admin/productcategory');
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
        $res = $this->productcategory->update($arr, $id);
        if ($res){
            flash('商品类别删除成功','success');
        }else{
            flash('商品类别删除失败','error');
        }
        return redirect('admin/productcategory');
    }

    /**
     * 接口获取信息
     */
    public function ajaxIndex(Request $request){
        $result = $this->productcategory->ajaxIndex($request);
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

        $productcategory = $this->productcategory->find($id)->toArray();

        $productcategory['create_at'] = toDate($productcategory['create_at'],'-',true);
        $productcategory['update_at']   = toDate($productcategory['update_at'],'-',true);
        return view('admin.productcategory.info', compact('id', 'productcategory'));
    }
}
