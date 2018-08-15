<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\Admin\ActionButtonTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class File extends Model
{
    use TransformableTrait;
    use EntrustUserTrait;
    use ActionButtonTrait;
    protected $table = 'cy_file';
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
