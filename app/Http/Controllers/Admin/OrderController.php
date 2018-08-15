<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\BusinessesRepositoryEloquent as BusinessesRepository;
use App\Repositories\Eloquent\PermissionRepositoryEloquent as PermissionRepository;
use App\Repositories\Eloquent\AdminUserRepositoryEloquent  as AdminUserRepository;
use App\Repositories\Eloquent\OrderRepositoryEloquent as OrderRepository;
use App\Repositories\Eloquent\OrderGoodsRepositoryEloquent as OrderGoodsRepository;
use App\Repositories\Eloquent\CommentRepositoryEloquent as CommentRepository;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public $businesses;
    public $permission;
    public $order;
    public $amdins;
    public $ordergoods;
    public $comment;

    public function __construct(
        BusinessesRepository  $businessesRepository,
        PermissionRepository  $permissionRepository,
        AdminUserRepository   $adminUserRepository,
        OrderRepository       $orderRepository,
        OrderGoodsRepository  $orderGoodsRepository,
        CommentRepository     $commentRepository
    )
    {
        // $this->mi dleware('CheckPermission:businesses');
        $this->businesses = $businessesRepository;
        $this->permission = $permissionRepository;
        $this->adminuser  = $adminUserRepository;
        $this->order      = $orderRepository;
        $this->ordergoods = $orderGoodsRepository;
        $this->comment    = $commentRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bid = 0;
        return view('admin.order.index', compact('bid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($bid = 0)
    {
        $order_type         =  $this->order->orderType();
        $order_status       =  $this->order->orderStatus();
        $pay_type           =  $this->order->payType();
        $pay_status         =  $this->order->payStatus();
        $settlement_status  =  $this->order->settlementStatus();
        $ticket_color       =  $this->order->ticketColor();
        $comment_status     =  $this->order->commentStatus();
        $is_tax             =  $this->order->isTaxMx();
        $bid        = intval($bid);

        return view('admin.order.create',compact( 'bid','order_type','pay_type','order_status','ticket_color','comment_status','is_tax','settlement_status','pay_status'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        //获取商户名
        $businessesName            = $this->businesses->find($request->all()['businesses_id'])->toArray();
        $arr = $request->all();
        $arr['businesses_name'] =  $businessesName['name'];
        $this->order->createOrder($arr);
        if($request->businesses_id){
            return redirect('admin/businesses/info/id/'.$request->businesses_id);
        }else{
            return redirect('admin/order');
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
        $arr_order_type         =  $this->order->orderType();
        $arr_order_status       =  $this->order->orderStatus();
        $arr_pay_type           =  $this->order->payType();
        $arr_pay_status         =  $this->order->payStatus();
        $arr_settlement_status  =  $this->order->settlementStatus();
        $arr_ticket_color       =  $this->order->ticketColor();
        $arr_comment_status     =  $this->order->commentStatus();
        $arr_is_tax             =  $this->order->isTaxMx();

        $order = $this->order->editViewData($id);

        //获取商户名
        $businessesName            = $this->businesses->find($order['merchant_id'])->toArray();
        $order['businesses_name']  =  ($businessesName)?$businessesName['name']:'商户信息';//获取商户name
        $user = $this->adminuser->findByField('id',$order['user_id'])->toArray();  //获取用户
        $order['user_name']        =  ($user)?$user[0]['name']:"";//获取用户名
        $order['create_time']      = toDate($order['create_time'], '-', true);  //时间格式化
        $order['update_at']        = toDate($order['update_at'], '-', true);


        return view('admin.order.edit',compact('order','arr_order_type','arr_order_status','arr_pay_type ','arr_pay_type','arr_pay_status','arr_settlement_status','arr_ticket_color','arr_comment_status','arr_is_tax'));
    }

    /**
     * Update the specified resource in storage. 更新
     * @param MenuRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->order->updateOrder($request->all(),$id);
        if($request->all()['merchant_id'] > 0){
            return redirect('admin/businesses/info/id/'.$request->all()['merchant_id']);
        }else{
            return redirect('admin/order');
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
                $re_data    = $this->order->delete($id);

                if($re_data){
                    flash('永久删除成功','success');
                }else{
                    flash('永久删除失败','error');
                }
                $re_url = 'admin/dash/order';
                break;
            default:
                $arr['order_status'] = 9;//软删除
                $businesses_id       = $this->order->find($id, ['merchant_id'])->merchant_id;  //查询 merchant_id
                $res                 = $this->order->update($arr, $id);
                if ($res){
                    flash('商品删除成功','success');
                }else{
                    flash('商品删除失败','error');
                }
                $re_url = 'admin/businesses/info/id/'.$businesses_id;
                break;
        }

        return redirect($re_url);
    }

    /**
     * 接口获取信息
     */
    public function ajaxIndex(Request $request){
        $result = $this->order->ajaxIndex($request);
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
          $user               = $this->adminuser->findByField('id',$order['user_id'])->toArray();
        if(!empty($user)){
            foreach($user as $k => $v){
                $order['user_name'] =  ($v)?$v['name']:'';//获取用户名
            }
        }else{
                $order['user_name'] =  '该用户不存在';//获取用户名
        }

        /**********获取订单购买产品信息***********/
        $condition  = 'id = '.$order['id'];
        $orderBy    = [
            ['id', 'asc']
        ];
        $ordergoods = $this->ordergoods->getList($condition, $orderBy);

        return view('admin.order.info', compact('id','order', 'ordergoods'));
    }

}
