<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use App\Models\Classes;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\BusinessesRepositoryEloquent as BusinessesRepository;
use App\Repositories\Eloquent\PermissionRepositoryEloquent as PermissionRepository;
use App\Repositories\Eloquent\AdminUserRepositoryEloquent  as AdminUserRepository;
use App\Repositories\Eloquent\GoodsRepositoryEloquent as GoodsRepository;
use App\Repositories\Eloquent\ClassesRepositoryEloquent as ClassesRepository;
use App\Repositories\Eloquent\GoodsPriceRepositoryEloquent as GoodsPriceRepository;
use App\Repositories\Eloquent\GalleryRepositoryEloquent as GalleryRepository;
use App\Repositories\Eloquent\FileRepositoryEloquent as FileRepository;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    public $businesses;
    public $permission;
    public $goods;
    public $classes;
    public $goodsprice;
    public $gallery;
    public $file;
    public function __construct(
        BusinessesRepository $businessesRepository,
        PermissionRepository $permissionRepository,
        AdminUserRepository  $adminUserRepository,
        GoodsRepository      $goodsRepository,
        ClassesRepository    $classesRepository,
        GoodsPriceRepository $goodsPriceRepository,
        GalleryRepository    $galleryRepository,
        FileRepository       $fileRepository
    )
    {
        // $this->middleware('CheckPermission:businesses');
        $this->businesses = $businessesRepository;
        $this->permission = $permissionRepository;
        $this->adminuser  = $adminUserRepository;
        $this->goods      = $goodsRepository;
        $this->classes    = $classesRepository;
        $this->goodsprice = $goodsPriceRepository;
        $this->gallery    = $galleryRepository;
        $this->file       = $fileRepository;
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
        $bid = intval($bid);
        if(!$bid){
            abort(500 , '参数错误 商户id错误');
        }
        //查询商品分类  针对此门店
        $arr_refer = $this->adminuser->arrRefer();
        $users     = $this->adminuser->getALlAdminUsers();
        $classes   = $this->classes->getList(' businesses_id = '.$bid);
        return view('admin.goods.create',compact('users', 'bid', 'classes','arr_refer'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
       $id = $this->goods->createGoods($request->all());
        if($id){
            $gallery_arr = [];
            $gallery_arr['goods_pictures'] = $request->goods_pictures;
            $goods_pic   = explode(",", $request->goods_pictures);
            foreach($goods_pic as $k => $v){
                $gallery_arr['goods_pictures'] = $v;
                $gallery_arr['goods_id']       = $id;
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
        $goods = $this->goods->editViewData($id);
        //图片缩略图
        $goods_img = $goods->goods_img;//缩略图id;
        $file_img = $this->file->findByField('id', $goods_img)->toArray();//
        if (!empty($file_img[0])) {
            $file_img = ($file_img) ? $file_img[0] : '';
            $path_img['path'] = $file_img['path'];
            $path_img['savename'] = $file_img['savename'];
            $path_img['size'] = round($file_img['size'], 1);
            $img_single[] = $path_img;
            //图片集
            if ($img_single) {
                $goods_id = $goods->id;
                $pic_gallery = $this->gallery->findByField('goods_id', $goods_id)->toArray();
                $path_pic = [];
                $pic_ids = [];
                foreach ($pic_gallery as $v) {
                    $file_id = intval($v['goods_pictures']);
                    $file = $this->file->findByField('id', $file_id)->toArray();
                    if($file){
                        $middle['path'] = $file[0]['path'];
                        $middle['savename'] = $file[0]['savename'];
                        $middle['size'] = round($file[0]['size'], 1);
                    }else{
                        continue;
                    }

                    $pic_ids[] = $v['goods_pictures'];
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
        $classes = $this->classes->getList(' businesses_id = ' . $goods->merchant_id);

        $host = 'http://' . $_SERVER["HTTP_HOST"];
        return view('admin.goods.edit', compact('goods', 'users', 'classes', 'arr_refer', 'path_img', 'path_pic', 'pic_ids', 'goods_img', 'host'));

    }
    /**
     * Update the specified resource in storage. 更新
     * @param MenuRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $this->goods->updateGoods($request->all(),$id);
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
                $re_data = $this->goods->delete($id);

                if($re_data){
                    flash('永久删除成功','success');
                }else{
                    flash('永久删除失败','error');
                }
                $re_url = 'admin/dash/goods';
                break;
            default:
                $arr['status'] = 9;//软删除
                $businesses_id       = $this->goods->find($id, ['merchant_id'])->merchant_id;  //查询 merchant_id
                $res = $this->goods->update($arr, $id);
                if ($res){
                    flash('删除成功','success');
                }else{
                    flash('删除失败','error');
                }
                $re_url ='admin/businesses/info/id/'.$businesses_id;
                break;
        }

        return redirect($re_url);
    }

    /**
     * 接口获取信息
     */
    public function ajaxIndex(Request $request){
        $result = $this->goods->ajaxIndex($request);
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

        $goods                      = $this->goods->find($id)->toArray();
        //获取商品图片
        $file_img                   = $this->file->findByField('id', $goods['goods_img'])->toArray();
        if(!empty($file_img[0]['path'])){
            $path_img               = ($file_img)?$file_img[0]['path']:'';
        }else{
            $path_img               = "";
        }

        //获取图片集
        $pic_gallery                = $this->gallery->findByField('goods_id', $goods['id'])->toArray();
      if(!empty($pic_gallery)){
          $path_pic                   =  [];
          foreach($pic_gallery as $v){
              $path_pic[]     =  $v['goods_pictures'];
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
        $goods['create_time']       = toDate($goods['create_time'], '-', true);
        $goods['update_time']       = toDate($goods['update_time'], '-', true);
        //获取商户name
        $businessesName             = $this->businesses->findByField('id', $goods['merchant_id'])->toArray();
        $goods['businesses_name']   =  ($businessesName)?$businessesName[0]['name']:'商户信息';
        //获取价格体系
        // $condition = 'id = '.$id;
        // $orderBy = [
        //     ['id', 'asc']
        // ];
        // $goodsprice = $this->goodsprice->getList($condition, $orderBy);
        return view('admin.goods.info', compact('goods', 'goodsprice','path_img','gallery'));
    }

}
