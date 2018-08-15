<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\Admin\ActionButtonTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class TipsRanking extends Model
{
    use TransformableTrait;
    use EntrustUserTrait;
    use ActionButtonTrait;
    protected $table = 'cy_businesses';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'address',
        'phone',
        'user_id',
        'update_at',
        'turnover',
        'status',
        'parent_id',
        'tag'
    ];

}
