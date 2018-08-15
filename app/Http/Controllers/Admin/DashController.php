<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use App\Models\Classes;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\PermissionRepositoryEloquent as PermissionRepository;
use App\Repositories\Eloquent\AdminUserRepositoryEloquent  as AdminUserRepository;
use App\Repositories\Eloquent\FileRepositoryEloquent as FileRepository;
use App\Http\Controllers\Controller;

class DashController extends Controller
{

    public $file;
    public function __construct(
        FileRepository       $fileRepository
    )
    {
        // $this->middleware('CheckPermission:businesses');
        $this->file       = $fileRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取全部信息
        return view('admin.dash.index');
    }


    /**
     * 商户回收站
     */
    public function bus(){
        //商户回收信息
         $getdata    = getsBusStatus();
        if($getdata){
            unset($getdata[9]);
        }else{
            $getdata = [];
        }
        $status     = json_encode($getdata);

        return view('admin.dash.bus', compact('status'));
    }

    /**
     * 员工回收站
     */
    public function staff(){
        //员工回收信息
        return view('admin.dash.staff');
    }

    /**
     * 商品产品分类回收站
     */
    public function classes(){
        //商品产品分类回收信息
        return view('admin.dash.classes');
    }

    /**
     * 商品属性分类回收站
     */
    public function gattr(){
        //商品属性分类回收信息
        return view('admin.dash.gattr');
    }
    /**
     *  产品回收站
     */
    public function goods(){
        //产品回收信息
        return view('admin.dash.goods');
    }

    public function order(){
        //订单回收信息
        return view('admin.dash.order');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($bid)
    {
        $bid = intval($bid);
        if(!$bid){
            abort(500 , '参数错误 商户id错误');
        }
        //查询商品分类  针对此门店
        $arr_refer = $this->adminuser->arrRefer();
        $users     = $this->adminuser->getALlAdminUsers();
        $classes   = $this->classes->getList(' businesses_id = '.$bid);
        return view('admin.Dash.create',compact('users', 'bid', 'classes','arr_refer'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
       $id = $this->Dash->createDash($request->all());
        if($id){
            $gallery_arr = [];
            $gallery_arr['Dash_pictures'] = $request->Dash_pictures;
            $Dash_pic   = explode(",", $request->Dash_pictures);
            foreach($Dash_pic as $k => $v){
                $gallery_arr['Dash_pictures'] = $v;
                $gallery_arr['Dash_id']       = $id;
                $gallery_arr['sort']           = $k;
                $this->gallery->createGallery($gallery_arr);
            }
        }
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
        $arr_refer = $this->adminuser->arrRefer();
        $Dash = $this->Dash->editViewData($id);
        //图片缩略图
        $Dash_img = $Dash->Dash_img;//缩略图id;
        $file_img = $this->file->findByField('id', $Dash_img)->toArray();//
        if (!empty($file_img[0])) {
            $file_img = ($file_img) ? $file_img[0] : '';
            $path_img['path'] = $file_img['path'];
            $path_img['savename'] = $file_img['savename'];
            $path_img['size'] = round($file_img['size'], 1);
            $img_single[] = $path_img;
            //图片集
            if ($img_single) {
                $Dash_id = $Dash->id;
                $pic_gallery = $this->gallery->findByField('Dash_id', $Dash_id)->toArray();
                $path_pic = [];
                $pic_ids = [];
                foreach ($pic_gallery as $v) {
                    $file_id = intval($v['Dash_pictures']);
                    $file = $this->file->find($file_id)->toArray();
                    $middle['path'] = $file['path'];
                    $middle['savename'] = $file['savename'];
                    $middle['size'] = round($file['size'], 1);
                    $pic_ids[] = $v['Dash_pictures'];
                    $path_pic[] = $middle;

                }
            }

            $pic_ids = implode(',', $pic_ids);
            $path_img = $img_single;
            $path_img = json_encode($path_img);
            $path_pic = json_encode($path_pic);
        }else{
            $pic_ids  = "";
            $path_pic = json_encode("");
            $path_img = json_encode("");//token
        }

        $users = $this->adminuser->getALlAdminUsers();
        $classes = $this->classes->getList(' businesses_id = ' . $Dash->merchant_id);

        $host = 'http://' . $_SERVER["HTTP_HOST"];
        return view('admin.Dash.edit', compact('Dash', 'users', 'classes', 'arr_refer', 'path_img', 'path_pic', 'pic_ids', 'Dash_img', 'host'));

    }
    /**
     * Update the specified resource in storage. 更新
     * @param MenuRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $this->Dash->updateDash($request->all(),$id);
        return redirect('admin/businesses/info/id/'.$request->all()['businesses_id']);
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
        //查询 merchant_id
        $merchant_id   = $this->Dash->find($id, ['merchant_id'])->merchant_id;
        $res           = $this->Dash->update($arr, $id);
        if ($res){
            flash('商品删除成功','success');
        }else{
            flash('商品删除失败','error');
        }
        return redirect('admin/businesses/info/id/'.$merchant_id);
    }

    /**
     * 接口获取信息
     */
    public function ajaxIndex(Request $request){
        $result = $this->Dash->ajaxIndex($request);
        return response()->json($result,JSON_UNESCAPED_UNICODE);
    }

    /**
     *
     * @param  [type] $id [产品id]
     * @return [type]     [数组]
     */
    public function info($id){
        //查询产品详细信息
        $id = intval($id);
        if(!$id){
            abort('参数错误');
        }

        $Dash                      = $this->Dash->find($id)->toArray();
        //获取商品图片
        $file_img                   = $this->file->findByField('id', $Dash['Dash_img'])->toArray();
        if(!empty($file_img[0]['path'])){
            $path_img               = ($file_img)?$file_img[0]['path']:'';
        }else{
            $path_img               = "";
        }

        //获取图片集
        $pic_gallery                = $this->gallery->findByField('Dash_id', $Dash['id'])->toArray();
      if(!empty($pic_gallery)){
          $path_pic                   =  [];
          foreach($pic_gallery as $v){
              $path_pic[]     =  $v['Dash_pictures'];
          }
          foreach($path_pic as $k => $v){
              $file[]         = $this->file->findByField('id', $v)->toArray();
          }
          foreach($file as $v1){
              foreach($v1 as $v2){
                  $gallery[]  = $v2['path'];
              }
          }
      }else{
          $gallery  = "";
      }

        //时间转换
        $Dash['create_time']       = toDate($Dash['create_time'], '-', true);
        $Dash['update_time']       = toDate($Dash['update_time'], '-', true);
        //获取商户name
        $businessesName             = $this->businesses->findByField('id', $Dash['merchant_id'])->toArray();
        $Dash['businesses_name']   =  ($businessesName)?$businessesName[0]['name']:'商户信息';
        //获取价格体系
        // $condition = 'id = '.$id;
        // $orderBy = [
        //     ['id', 'asc']
        // ];
        // $Dashprice = $this->Dashprice->getList($condition, $orderBy);
        return view('admin.Dash.info', compact('Dash', 'Dashprice','path_img','gallery'));
    }

}
