<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\Admin\ActionButtonTrait;

class Street extends Model
{
    use TransformableTrait;
    use ActionButtonTrait;
    protected $table = 'cy_street';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'size',
        'ext',
        'md5',
        'shal',
        'mime',
        'savename',
        'savepath',
        'location',
        'path',
        'abs_url',
        'oss_path',
        'update_at',
        'status',
        'create_time',
    ];

}
