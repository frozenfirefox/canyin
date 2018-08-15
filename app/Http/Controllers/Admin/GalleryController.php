<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\GalleryRepositoryEloquent as GalleryRepository;
use App\Repositories\Eloquent\PermissionRepositoryEloquent as PermissionRepository;
use App\Repositories\Eloquent\AdminUserRepositoryEloquent  as AdminUserRepository;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public $gallery;
    public $permission;

    public function __construct(GalleryRepository $galleryRepository,PermissionRepository $permissionRepository,AdminUserRepository $adminUserRepository)
    {
        // $this->middleware('CheckPermission:businesses');
        $this->gallery    = $galleryRepository;
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
        return view('admin.gallery.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = $this->adminuser->getALlAdminUsers();
        return view('admin.gallery.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->gallery->createGallery($request->all());
        return redirect('admin/gallery');
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
        $gallery = $this->gallery->editViewData($id);
        $gallery['id'] = $id;
        $users   = $this->adminuser->getALlAdminUsers();
        return view('admin.gallery.edit',compact('gallery', 'users'));
    }

    /**
     * Update the specified resource in storage. 更新
     * @param MenuRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->gallery->updateGallery($request->all(),$id);
        return redirect('admin/gallery');
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
        $res = $this->gallery->update($arr, $id);
        if ($res){
            flash('商品图片集删除成功','success');
        }else{
            flash('商品图片集删除失败','error');
        }
        return redirect('admin/gallery');
    }

    /**
     * 接口获取信息
     */
    public function ajaxIndex(Request $request){
        $result = $this->gallery->ajaxIndex($request);
        return response()->json($result,JSON_UNESCAPED_UNICODE);
    }
}
