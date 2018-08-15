<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\Admin\ActionButtonTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Ticket extends Model
{
    use TransformableTrait;
    use EntrustUserTrait;
    use ActionButtonTrait;
    protected $table = 'cy_ticket';
    public $timestamps = false;
    protected $fillable = [
        'ticket_code',
        'ticket_name',
        'merchant_id',
        'true_use_num',
        'limit_num',
        'ticket_desc',
        'ticket_type',
        'value',
        'condition',
        'goods_id',
        'use_num',
        'ticket_num',
        'start_time',
        'end_time',
        'status',
        'create_at',
        'update_at',
    ];

}
