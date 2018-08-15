<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\Admin\ActionButtonTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Tips extends Model
{
    use TransformableTrait;
    use EntrustUserTrait;
    use ActionButtonTrait;
    protected $table = 'cy_tips';
    public $timestamps = false;
    protected $fillable = [
        'ct_user_id',
        'ct_qrcode',
        'ct_bus_id',
        'ct_tuser_id',
        'ct_order_id',
        'ct_food_id',
        'ct_target',
        'ct_paytype',
        'ct_amount',
        'ct_memo',
        'ct_status',
        'ct_create_time',
    ];
}
