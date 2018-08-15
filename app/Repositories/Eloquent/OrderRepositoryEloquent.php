<?php

namespace App\Repositories\Eloquent;

use DB;
use App\Models\Permission;
use App\Models\Order;
use App\Models\AdminUser;
use App\Models\Classes;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\OrderRepository as OrderRepositoryInterface;

/**
 * Class MenuRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function ajaxIndex($request)
    {
        $draw            = $request->input('draw',1);
        $bid             = $request->input('bid', 0);
        $dash            = $request->input('is_dash', 0);
        $start           = $request->input('start',0);
        $length          = $request->input('length',10);
        $order['name']   = $request->input('columns.' .$request->input('order.0.column') . '.name');
        $order['dir']    = $request->input('order.0.dir','asc');
        $search['value'] = $request->input('search.value','');
        $search['regex'] = $request->input('search.regex',false);
        $con_status = ($dash)?'order_status = 9':'order_status <> 9';
        if ($search['value']){
            $keywords = "%{$search['value']}%";
            $kyewordsValue = "{$search['value']}";
            $namelike = "%{$search['value']}%";
            $nameValue = "{$search['value']}";
            if ($search['regex'] == 'true'){
                $this->model = $this->model->whereRaw('('.$con_status.'  and (order_sn like ? or receiver like ?))',[$bid, $namelike, $keywords]);
            }else{
                $this->model = $this->model->whereRaw('('.$con_status.' and (order_sn = ? or receiver = ?))',[$bid, $nameValue, $kyewordsValue]);
            }
        }else{
            $this->model = $this->model->whereRaw($con_status);
        }

        $count = $this->model->count();
        $this->model = $this->model->orderBy($order['name'],$order['dir']);
        $this->model = $this->model->offset($start)->limit($length)->get();

        if ($this->model) {
            foreach ($this->model as $item) {
                $item->create_time      = toDate($item->create_time, '-', true);//创建时间
                $item->update_at        = toDate($item->update_at, '-', true);//更新时间
                $username               = DB::table('admins')->where('id',$item->user_id)->select(['name'])->first();
                $item->user_name        = ($username)?$username->name:'';//经理姓名
                $businessesName         = DB::table('cy_businesses')->where('id',$item->merchant_id)->select(['name'])->first();
                $item->businesses_name  = ($businessesName)?$businessesName->name:'';//获取商户name

                $item->dash         = $dash;//是否为回收站 删除
                if($dash){
                    $item->button   = $item->getActionButtons('orderdash');
                }else{
                    $item->button   = $item->getActionButtons('order', '', true);
                }

                $order_type = [
                    0 =>'普通订单',
                    1 =>'会员订单',
                ];
                $item->order_type = $order_type[$item->order_type];
            }
        }

        return [
            'draw'              =>$draw,
            'recordsTotal'      =>$count,
            'recordsFiltered'   =>$count,
            'data'              =>$this->model
        ];
    }

    public function editViewData($id)
    {
        $order = $this->find($id);
        if ($order) {
            return $order;
        }
        abort(404);
    }

    /**
     * 添加新商户
     */
    public function createOrder(array $attr)
    {

        $orderModel                 = new Order();
        $attr['order_sn']           =  createSnCode();
        $orderModel->order_sn       = $attr['order_sn'];
        $orderModel->merchant_id    = $attr['businesses_id'];
        $orderModel->merchant_name  = $attr['businesses_name'];
        $orderModel->user_id        = $attr['user_id'];
        $orderModel->order_type     = $attr['order_type'];
        $orderModel->receiver       = $attr['receiver'];
        $orderModel->phone          = $attr['phone'];
        $orderModel->address        = $attr['address'];
        $orderModel->pay_type       = $attr['pay_type'];
        $orderModel->pay_status     = $attr['pay_status'];
        $orderModel->order_status   = $attr['order_status'];
        $orderModel->goods_num      = $attr['goods_num'];
        $orderModel->freight        = $attr['freight'];
        $orderModel->pay_time       = $attr['pay_time'];
        $orderModel->comment_status = $attr['comment_status'];
        $orderModel->mark           = $attr['mark'];
        $orderModel->create_time    = time();
        $orderModel->save();
        flash('订单新增成功', 'success');
    }

    /**
     * [updateOrder description]
     * @param  array  $attr [description]
     * @param  [type] $id   [description]
     * @return [type]       [description]
     */
     public function updateOrder(array $attr, $id)
    {

        $attr['update_at'] = time();
//        $update['mark']      = $attr['mark'];
        $res = $this->update($attr, $id);
        if ($res) {
            flash('修改成功!', 'success');
        } else {
            flash('修改失败!', 'error');
        }
        return $res;
    }
    public function updateOrderG(array $attr, $id)
    {
        $attr['update_at'] = time();
        $order= $this->find($id);
        $order_price= $order->order_price;
        $attr['order_price'] = $order_price+ $attr['shop_price']*$attr['goods_num'];
        $res = $this->update($attr, $id);
        if ($res) {
            flash('订购成功!', 'success');
        } else {
            flash('订购失败!', 'error');
        }
        return $res;
    }
    //订单类型
    public function orderType(){
        $order_type = [
            0 =>'普通订单',
            1 =>'会员订单',
        ];
        return $order_type;
    }



    //订单状态
    public function orderStatus(){
        $order_status = [
            0 => '待支付',
            1 => '待发货',
            2 => '待收货',
            3 => '待评价',
            4 => '已完成',
            5 => '已取消',
            9 => '删除',
        ];
        return $order_status;

    }

    //支付方式
    public function payType(){
        $pay_type = [
            0 =>'微信支付',
            1 =>'支付宝',
            2 =>'银联支付',
            3 =>'余额支付',
            4 =>'积分支付',
        ];
        return $pay_type;
    }

    //支付状态
    public function payStatus(){
        $pay_status = [
            0 => '未支付',
            1 =>'已支付',

        ];
        return $pay_status;

    }


    //是否需要
    public function settlementStatus(){
        $settlement_status = [
            0 =>'需要',
            1 =>'不需要'

        ];
        return $settlement_status;
    }


    //代金券使用
    public function ticketColor(){

        $ticket_color = [
            0 => '未使用代金券',
            1 =>'红',
            2 =>'黄',
            3 =>'蓝',
        ];
        return $ticket_color;

    }

//订单评论状态
    public function commentStatus(){
        $comment_status = [
            0 => '未评论',
            1 =>'已评论',

        ];
        return $comment_status;

    }

//是否开具发票
    public function isTaxMx(){
        $is_tax = [
            0 => '是',
            1 =>'否',

        ];
        return $is_tax;
    }

}
