<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\Admin\ActionButtonTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Comment extends Model
{
    use TransformableTrait;
    use EntrustUserTrait;
    use ActionButtonTrait;
    protected $table = 'cy_comment';
    public $timestamps = false;
    protected $fillable = [
        'user1_id',
        'user2_id',
        'pid',
        'content',
        'module_id',
        'type',
        'index',
        'create_at',
        'update_at',
        'status',
    ];

}
