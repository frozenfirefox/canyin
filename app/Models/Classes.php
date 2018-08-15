<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\Admin\ActionButtonTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Classes extends Model
{
    use TransformableTrait;
    use EntrustUserTrait;
    use ActionButtonTrait;
    protected $table = 'cy_classes';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'calss_type',
        'parent_id',
        'businesses_id',
        'status',
        'create_at',
        'update_at',
        'description'
    ];

}
