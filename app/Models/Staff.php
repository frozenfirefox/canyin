<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\Admin\ActionButtonTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Staff extends Model
{
    use TransformableTrait;
    use EntrustUserTrait;
    use ActionButtonTrait;
    protected $table = 'cy_staff';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'phone',
        'businesses_id',
        'position',
        'parent_id',
        'create_at',
        'update_at',
        'status',
    ];

}
