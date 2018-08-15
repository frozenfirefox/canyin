<?php

namespace App\Repositories\Eloquent;

use DB;
use App\Models\Permission;
use App\Models\OrderGoods;
use App\Models\AdminUser;
use App\Models\Classes;
use App\Models\Goods;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\OrderGoodsRepository as OrderGoodsRepositoryInterface;

/**
 * Class MenuRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class OrderGoodsRepositoryEloquent extends BaseRepository implements OrderGoodsRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OrderGoods::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @description 根据条件查询数据  带有排序
     * @param  $condition string [字符窜 类似 id = 1 and row = 2 ....]
     * @param  $order [array] [必须是 [['id','asc'],....] 是一个二维数组]
     * @return [type] [array] [返回数组]
     */
    public function getList($condition , $order = []){
        $this->model->whereRaw('status <> 9 and '.$condition);
        if($order){
            foreach ($order as $value) {
                $this->model->orderBy($value[0], $value[1]);
            }
        }
        $ordergoods = $this->model->get()->toArray();
        if($ordergoods){
            foreach ($ordergoods as &$item) {
                //查询到商品名称
                $goodsname          = DB::table('cy_goods')->where('id', $item['goods_id'])->select(['goods_name'])->first();
                $item['goods_name']   = ($goodsname)?$goodsname->goods_name:'';//商品名
            }
        }
        return $ordergoods;
    }

    public function ajaxIndex($request)
    {
        $draw            = $request->input('draw',1);
        $oid             = $request->input('oid', 0);
        $start           = $request->input('start',0);
        $length          = $request->input('length',10);
        $order['name']   = $request->input('columns.' .$request->input('order.0.column') . '.name');
        $order['dir']    = $request->input('order.0.dir','asc');
        $search['value'] = $request->input('search.value','');
        $search['regex'] = $request->input('search.regex',false);

        if ($search['value']){
            $keywords = "%{$search['value']}%";
            $kyewordsValue = "{$search['value']}";
            $namelike = "%{$search['value']}%";
            $nameValue = "{$search['value']}";
            if ($search['regex'] == 'true'){
                $this->model = $this->model->whereRaw('status <> 9  and (order_id like ? or)',[$oid, $namelike, $keywords]);
            }else{
                $this->model = $this->model->whereRaw('status <> 9  and (order_id = ? )',[$oid, $nameValue, $kyewordsValue]);
            }
        }else{
            $this->model = $this->model->whereRaw('status <> 9 and order_id = '.$oid);
        }

        $count = $this->model->count();
        $this->model = $this->model->orderBy($order['name'],$order['dir']);
        $this->model = $this->model->offset($start)->limit($length)->get();

        if ($this->model) {
            foreach ($this->model as $item) {
                $item->create_time  = toDate($item->create_time, '-', true);//创建时间
                $item->update_time  = toDate($item->update_at, '-', true);//更新时间
                $item->button       = $item->getActionButtons('ordergoods');
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
        $staff = $this->find($id);
        if ($staff) {
            return $staff;
        }
        abort(404);
    }

    /**
     * 添加新商户
     */
    public function createOrderGoods(array $attr)
    {

        $orderGoodsModel                             = new OrderGoods();
        $orderGoodsModel->order_id                   = $attr['order_id'];
        $orderGoodsModel->merchant_id                = $attr['merchant_id'];
        $orderGoodsModel->goods_id                   = $attr['goods_id'];
        $orderGoodsModel->merchant_name              = $attr['merchant_name'];
        $orderGoodsModel->goods_attr                 = $attr['goods_attr'];
        $orderGoodsModel->settlement_price           = $attr['settlement_price'];
        $orderGoodsModel->shop_price                 = $attr['shop_price'];
        $orderGoodsModel->market_price               = $attr['market_price'];
        $orderGoodsModel->discount                   = $attr['discount'];
        $orderGoodsModel->yellow_discount            = $attr['yellow_discount'];
        $orderGoodsModel->blue_discount              = $attr['blue_discount'];
        $orderGoodsModel->red_return_integral        = $attr['red_return_integral'];
        $orderGoodsModel->yellow_return_integral     = $attr['yellow_return_integral'];
        $orderGoodsModel->goods_num                  = $attr['goods_num'];
        $orderGoodsModel->send_company               = $attr['send_company'];
        $orderGoodsModel->send_nu                    = $attr['send_nu'];
        $orderGoodsModel->delivery_time              = $attr['delivery_time'];
        $orderGoodsModel->sure_delivery_time         = $attr['sure_delivery_time'];
        $orderGoodsModel->after_type                 = $attr['after_type'];
        $orderGoodsModel->comment_status             = $attr['comment_status'];
        $orderGoodsModel->is_sales                   = $attr['is_sales'];
        $orderGoodsModel->is_invoice                 = $attr['is_invoice'];
        $orderGoodsModel->invoice_type_id            = $attr['invoice_type_id'];
        $orderGoodsModel->invoice_rise               = $attr['invoice_rise'];
        $orderGoodsModel->rise_name                  = $attr['rise_name'];
        $orderGoodsModel->invoice_detail             = $attr['invoice_detail'];
        $orderGoodsModel->recognition                = $attr['recognition'];
        $orderGoodsModel->tax_pay                    = $attr['tax_pay'];
        $orderGoodsModel->express_fee                = $attr['express_fee'];
        $orderGoodsModel->status                     = $attr['status'];
        $orderGoodsModel->total                      = $attr['goods_num']*$attr['shop_price'];
        $orderGoodsModel->create_time                = time();
        $orderGoodsModel->save();
        flash('产品新增成功', 'success');
    }

    /**
     * [updateOrderGoods description]
     * @param  array  $attr [description]
     * @param  [type] $id   [description]
     * @return [type]       [description]
     */
     public function updateOrderGoods(array $attr, $id)
    {

        $attr['update_time'] = time();
        $attr['total'] =  $attr['shop_price']* $attr['goods_num'] ;

        $res = $this->update($attr, $id);

        if ($res) {
            flash('修改成功!', 'success');
        } else {
            flash('修改失败!', 'error');
        }
        return $res;
    }


    public  function  sendType(){
        $send_type = [
            0 => '不配送',
            1 => '蜂鸟配送',
            2 => '其他',
        ];
        return $send_type;

    }
    public  function  statusBuy(){
        $status_buy = [
            0 => '已收货',
            1 => '未收货',
            2 => '延时收货',
        ];
        return $status_buy;

    }

    public  function  afterType(){
        $after_type = [
            0 => '正常',
            1 => '退货',
        ];
        return $after_type;

    }

    public  function  commentStatus(){
        $comment_status = [
            0 => '已评价',
            1 => '未评价',
        ];
        return $comment_status;
    }

    public  function  isSales(){
        $is_sales = [
            0 => '不同意',
            1 => '同意',
        ];
        return $is_sales;
    }
    public  function  isInvoice(){
        $is_invoice = [
            0 => '否',
            1 => '是',
        ];
        return $is_invoice;
    }

    public  function  invoiceRise(){
        $invoice_rise = [
            0 => '个人',
            1 => '公司',
        ];
        return $invoice_rise;
    }


}
