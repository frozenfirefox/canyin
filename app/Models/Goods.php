<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\Admin\ActionButtonTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Goods extends Model
{
    use TransformableTrait;
    use EntrustUserTrait;
    use ActionButtonTrait;
    protected $table = 'cy_goods';
    public $timestamps = false;
    protected $fillable = [
        'goods_name',
        'keyword',
        'goods_brief',
        'goods_desc',
        'goods_img',
        'goods_typeid',
        'is_refer',
        'create_time',
        'update_time',
        'status',
    ];

}
