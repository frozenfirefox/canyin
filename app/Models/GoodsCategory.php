<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\Admin\ActionButtonTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class GoodsCategory extends Model
{
    use TransformableTrait;
    use EntrustUserTrait;
    use ActionButtonTrait;
    protected $table = 'cy_goods_category';
    public $timestamps = false;
    protected $fillable = [
        'goods_id',
        'name',
        'short_name',
        'cate_img',
        'parent_id',
        'min_rate',
        'sort',
        'create_at',
        'update_at',
        'status',
    ];

}
