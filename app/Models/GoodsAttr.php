<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\Admin\ActionButtonTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class GoodsAttr extends Model
{
    use TransformableTrait;
    use EntrustUserTrait;
    use ActionButtonTrait;
    protected $table = 'cy_goods_attr';
    public $timestamps = false;
    protected $fillable = [
        'goods_id',
        'goods_attr_id',
        'goods_attr_value',
        'goods_attr_assignment',
        'businesses_id',
        'classes_type',
        'status',
    ];

}
