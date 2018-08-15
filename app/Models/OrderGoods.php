<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\Admin\ActionButtonTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class OrderGoods extends Model
{
    use TransformableTrait;
    use EntrustUserTrait;
    use ActionButtonTrait;
    protected $table = 'cy_order_goods';
    public $timestamps = false;
    protected $fillable = [

        'order_id',
        'merchant_id',
        'merchant_name',
        'goods_id',
        'goods_attr',
        'settlement_price',
        'shop_price',
        'market_price',
        'goods_img',
        'discount',
        'yellow_discount',
        'blue_discount',
        'red_return_integral',
        'yellow_return_integral',
        'goods_num',
        'total',
        'send_company',
        'send_nu',
        'delivery_time',
        'sure_delivery_time',
        'after_type',
        'comment_status',
        'is_sales',
        'is_invoice',
        'invoice_type_id',
        'invoice_rise',
        'rise_name',
        'invoice_detail',
        'recognition',
        'tax_pay',
        'express_fee',
        'create_time',
        'update_at',
        'status',
    ];

}
