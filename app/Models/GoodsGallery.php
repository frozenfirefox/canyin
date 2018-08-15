<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\Admin\ActionButtonTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class GoodsGallery extends Model
{
    use TransformableTrait;
    use EntrustUserTrait;
    use ActionButtonTrait;
    protected $table = 'cy_goods_gallery';
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
        'goods_num',
        'create_time',
        'update_time',
        'status',
    ];

}
