<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\Admin\ActionButtonTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Order extends Model
{
    use TransformableTrait;
    use EntrustUserTrait;
    use ActionButtonTrait;
    protected $table = 'cy_order';
    public $timestamps = false;
    protected $fillable = [
        'order_sn',
        'merchant_id',
        'merchant_name',
        'user_id',
        'order_type',
        'receiver',
        'phone',
        'address',
        'pay_type',
        'pay_status',
        "settlement_status",
        "settlement_time",
        'settlement_end_time',
        'order_goods_id',
        'order_status',
        'goods_num',
        'use_integral',
        "ticket_color",
        'pay_tickets',
        'order_price',
        'freight',
        'pay_time',
        'comment_status',
        'mark',
        'create_time',
        'update_at'
    ];

}
