<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\Admin\ActionButtonTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class TipsSetting extends Model
{
    use TransformableTrait;
    use EntrustUserTrait;
    use ActionButtonTrait;
    protected $table = 'cy_tips_setting';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'cts_type',
        'cts_smileflag',
        'cts_smilerate',
        'cts_smilemin',
        'cts_def_amount',
        'cts_memo',
        'cts_create_time',
        'cts_create_user',
        'cts_update_time',
        'cts_update_user'
    ];

}
