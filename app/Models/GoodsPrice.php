<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\Admin\ActionButtonTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class GoodsPrice extends Model
{
    use TransformableTrait;
    use EntrustUserTrait;
    use ActionButtonTrait;
    protected $table = 'cy_goods_price';
    public $timestamps = false;
    protected $fillable = [
        'goods_id',
        'goods_specification',
        'settlement_price',
        'shop_price',
        'market_price',
        'goods_unit_type',
        'goods_weight',
        'goods_img',
        'status',
        'wy_price',
        'yx_price',
        'integral',
        'discount',
        'red_rurn_integral',
        'yellow_discount',
        'yellow_return_integral',
        'blue_discount',
        'create_at',
        'update_at',
    ];

}
