<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use App\Repositories\Eloquent\GoodsAttrRepositoryEloquent;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\BusinessesRepositoryEloquent as BusinessesRepository;
use App\Repositories\Eloquent\PermissionRepositoryEloquent as PermissionRepository;
use App\Repositories\Eloquent\AdminUserRepositoryEloquent  as AdminUserRepository;
use App\Repositories\Eloquent\GoodsPriceRepositoryEloquent as GoodsPriceRepository;
use App\Repositories\Eloquent\GoodsAttrRepositoryEloquent as GoodsAttrRepository;
use App\Repositories\Eloquent\FileRepositoryEloquent as FileRepository;
use App\Repositories\Eloquent\GoodsRepositoryEloquent as GoodsRepository;
use App\Repositories\Eloquent\ClassesRepositoryEloquent as ClassesRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class GoodsPriceController extends Controller
{
    public $businesses;
    public $permission;
    public $goodsprice;
    public $classes;
    public $goods;
    public $goodsattr;
    public $file;

    public function __construct(BusinessesRepository $businessesRepository,PermissionRepository $permissionRepository,AdminUserRepository $adminUserRepository, GoodsPriceRepository $goodsPriceRepository, ClassesRepository $classesRepository, GoodsRepository $goodsRepository,GoodsAttrRepository $goodsAttrRepository,FileRepository $fileRepository)
    {
        // $this->middleware('CheckPermission:businesses');
        $this->businesses = $businessesRepository;
        $this->permission = $permissionRepository;
        $this->adminuser  = $adminUserRepository;
        $this->goodsprice = $goodsPriceRepository;
        $this->classes    = $classesRepository;
        $this->goods      = $goodsRepository;
        $this->goodsattr  = $goodsAttrRepository;
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
    public function create($gid = 2)
    {
        $gid = intval($gid);
        if(!$gid){
            abort(500 , '参数错误 商户id错误');
        }
        //查找产品信息
        $goods      = $this->goods->find($gid)->toArray();
        $goodsattr  = $this->classes->getList('class_type=2');//获取name\id\class_type   eg：分量、口味
        foreach($goodsattr as $k => $v){
        $goodsattr2[$v['id']] =  $this->goodsattr->getAttr('classes_type='.$v["id"]);//获取name\id\class_type   eg：分量、口味
        }

        //查询商品分类  针对此门店
        // $classes = $this->classes->getList(' businesses_id = '.$gid);
        // $users = $this->adminuser->getALlAdminUsers();
        return view('admin.goodsprice.create',compact('users', 'gid', 'goods','goodsattr','goodsattr2'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {   $name = $request->all();
        $reg  = '/name_[1-9]\d*/';
        $keys = array_keys($name) ;
        foreach($keys as $k => $v){
            if(preg_match($reg,$v)){
                $id      = str_replace('name_', '', $v);
               $arr[$id] = $name[$v];
            }
        }
        $name['goods_attr'] = json_encode($arr);
        $this->goodsprice->createGoodsPrice($name);
        return redirect('admin/goods/info/id/'.$request->all()['goods_id']);
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
        $goodsprice               = $this->goodsprice->editViewData($id);
        $goodsprice['goods_name'] = $this->goods->find($goodsprice['goods_id'])->toArray()['goods_name'];

        $goods_attr_sql           = json_decode($goodsprice['goods_attr'], true);
        $goodsattr                = $this->classes->getList('class_type=2');//获取name\id\class_type   eg：分量、口味
        foreach($goodsattr as $k => $v){
            $goodsattr2[$v['id']] =  $this->goodsattr->getAttr('classes_type='.$v["id"]);//获取name\id\class_type   eg：分量、口味
        }
        //图片缩略图
        $goods_img = $goodsprice['goods_img'];//缩略图id;
        $file_img  = $this->file->findByField('id', $goods_img)->toArray();

        if(!empty($file_img)){
            foreach($file_img as $v){
                $path_img['path']     = $v['path'];
                $path_img['savename'] = $v['savename'];
                $path_img['size']     = round($v['size'], 1);
            }
            $path_img  = json_encode([$path_img]);
        }else{
            $path_img  = json_encode("");
        }
        $host      ='http://'.$_SERVER["HTTP_HOST"];
        return view('admin.goodsprice.edit',compact('goodsprice','goodsattr','goodsattr2','goods_attr_sql','path_img','goods_img','host'));
    }

    /**
     * Update the specified resource in storage. 更新
     * @param MenuRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->goodsprice->updateGoodsPrice($request->all(),$id);
        return redirect('admin/goods/info/id/'.$request->all()['goods_id']);
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
        $goods_id      = $this->goodsprice->find($id, ['goods_id'])->goods_id; //查询 merchant_id
        $res           = $this->goodsprice->update($arr, $id);
        if ($res){
            flash('商品删除成功','success');
        }else{
            flash('商品删除失败','error');
        }
        return redirect('admin/goods/info/id/'.$goods_id);
    }

    /**
     * 接口获取信息
     */
    public function ajaxIndex(Request $request){
        $result = $this->goodsprice->ajaxIndex($request);
        return response()->json($result,JSON_UNESCAPED_UNICODE);
    }

    /**
     *
     * @param  [type] $id [产品id]
     * @return [type]     [数组]
     */
    public function info($id){
        //todo 添加员工
        $id = intval($id);
        if(!$id){
            abort('参数错误');
        }

        $goodsprice               = $this->goodsprice->find($id)->toArray();
        $goodsprice['goods_name'] = $this->goods->find($goodsprice['goods_id'])->toArray()['goods_name'];
        $goods_attr_sql           = json_decode($goodsprice['goods_attr'], true);
        if($goods_attr_sql){
            foreach($goods_attr_sql as $k=>$v){
                $middle                      = $this->classes->findByField('id', $k)->toArray()[0];
                $goodsattr[$middle['name']]  = $this->goodsattr->getAttr('id='.$v);
            }
        }else{
            $goodsattr = [];
        }


//        $file_img  = $this->file->find($goodsprice['goods_img'])->toArray();
        $file_img  = $this->file->findByField("id",$goodsprice['goods_img'])->toArray();
        if($file_img){
            $path_img  =$file_img[0]['path'];
        }else{
            $path_img  = "";
        }

        $host = 'http://' . $_SERVER["HTTP_HOST"];
        return view('admin.goodsprice.info', compact('goodsprice','goodsattr','path_img','host'));
    }




}
