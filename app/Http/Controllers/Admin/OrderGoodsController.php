<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\BusinessesRepositoryEloquent as BusinessesRepository;
use App\Repositories\Eloquent\PermissionRepositoryEloquent as PermissionRepository;
use App\Repositories\Eloquent\AdminUserRepositoryEloquent  as AdminUserRepository;
use App\Repositories\Eloquent\OrderRepositoryEloquent as OrderRepository;
use App\Repositories\Eloquent\OrderGoodsRepositoryEloquent as OrderGoodsRepository;
use App\Repositories\Eloquent\GoodsRepositoryEloquent  as GoodsRepository;
use App\Http\Controllers\Controller;


class OrderGoodsController extends Controller
{
    public $businesses;
    public $permission;
    public $order;
    public $amdins;
    public $ordergoods;
    public $goods;

    public function __construct(
        BusinessesRepository  $businessesRepository,
        PermissionRepository  $permissionRepository,
        AdminUserRepository   $adminUserRepository,
        OrderRepository       $orderRepository,
        OrderGoodsRepository  $orderGoodsRepository,
        GoodsRepository       $goodsRepository
    )
    {
        // $this->middleware('CheckPermission:businesses');
        $this->businesses = $businessesRepository;
        $this->permission = $permissionRepository;
        $this->adminuser  = $adminUserRepository;
        $this->order      = $orderRepository;
        $this->ordergoods = $orderGoodsRepository;
        $this->goods      = $goodsRepository;
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

        $oid = 0;
        return view('admin.ordergoods.index', compact('oid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($oid = 0)
    {
        $order     = $this->order->editViewData($oid);//获取订单里商户的id;
        $goods     = $this->goods->editAllData('merchant_id',$order['merchant_id']);//获取订单里商户的id;
        $goods_id  = [];
        //获取goods表中的goods_id,goods_name
        foreach($goods as $k => $v){
            $goods_id[$k]['id']  = $v['id'];
            $goods_id[$k]['goods_name'] = $v['goods_name'];
        }


        //获取自定义数组
        $send_type         =  $this->ordergoods->sendType();
        $status_buy       =  $this->ordergoods->statusBuy();
        $after_type     =  $this->ordergoods->afterType();
        $comment_status   =  $this->ordergoods->commentStatus();
        $is_sales        = $this->ordergoods->isSales();
        $is_invoice        = $this->ordergoods->isInvoice();
        $invoice_rise        = $this->ordergoods->invoiceRise();

        $oid        = intval($oid);
        return view('admin.ordergoods.create',compact("order", 'oid','goods_id','send_type','status_buy','after_type','comment_status','is_sales','is_invoice ','is_invoice','invoice_rise'));

    }



    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $this->ordergoods->createOrderGoods($request->all());
        $arr['shop_price'] = $request->shop_price;
        $arr['goods_num']  = $request->goods_num;

        $this->order->updateOrderG($arr,$request->order_id);

        if($request->order_id){
            return redirect('admin/order/info/id/'.$request->order_id);
        }else{
            return redirect('admin/ordergoods');
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

        $ordergoods = $this->ordergoods->editViewData($id);
        //获取商户名

        return view('admin.ordergoods.edit',compact('ordergoods'));
    }

    /**
     * Update the specified resource in storage. 更新
     * @param MenuRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        $this->ordergoods->updateOrderGoods($request->all(),$request->all()['id']);
        if($request->all()['id'] > 0){

            return redirect('admin/order/info/id/'.$request->all()['id']);
        }else{
            return redirect('admin/ordergoods');
        }
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
//        $businesses_id       = $this->ordergoods->findByField('id',$id );  //查询 merchant_id
//        $merchant_id         =$businesses_id[0]['merchant_id'];
        $res                 = $this->ordergoods->update($arr, $id);
        if($res){

            //获取order_goods里的total小计
            $ordergoods          = $this->ordergoods->findByField('id',$id);
            $total = $ordergoods[0]['total'];
            //获取order表里的order_price;
            $order           = $this->order->findByField('id',$ordergoods[0]['order_id']);
            $old_order_price =  $order[0]['order_price'];
            $new_order_price =  $old_order_price-$total;
            $order_id        =  $order[0]['id'];
            //获取相减后的order_price
            $arr_order['order_price']  = $new_order_price;
            $bool                = $this->order->update($arr_order, $ordergoods[0]['order_id']);

            if ($bool){
                flash('商品删除成功','success');
            }else{
                flash('商品删除失败','error');
            }

            if($order_id > 0){
                return redirect('admin/order/info/id/'.$order_id);
            }else{
                return redirect('admin/order');
            }
        }


    }

    /**
     * 接口获取信息
     */
    public function ajaxIndex(Request $request){
        $result = $this->ordergoods->ajaxIndex($request);
        return response()->json($result,JSON_UNESCAPED_UNICODE);
    }

    /**
     * [ description]
     * @param [type] $id [description]
     * @return  模板文件 [<description>]
     */
    public function info($id){
        //todo 添加员工
        $id = intval($id);
        if(!$id){
            abort('参数错误');
        }

        $order = $this->order->find($id)->toArray();
        $order['create_time']  = toDate($order['create_time'], '-', true);
        $order['update_at']    = toDate($order['update_at'], '-', true);
        //获取商户名
        $businessesName           = $this->businesses->find($order['merchant_id'])->toArray();
        $order['businesses_name'] =  ($businessesName)?$businessesName['name']:'商户信息';//获取商户name
        //获取用户
        $user               = $this->adminuser->find($order['user_id'])->toArray();
        $order['user_name'] =  ($user)?$user['name']:'';//获取用户名

        /**********获取订单购买产品信息***********/
        $condition  = 'id = '.$order['id'];
        $orderBy    = [
            ['id', 'asc']
        ];
        $ordergoods = $this->ordergoods->getList($condition, $orderBy);

        return view('admin.order.info', compact('id','order', 'ordergoods'));
    }

}
