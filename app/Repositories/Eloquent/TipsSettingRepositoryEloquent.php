<?php

namespace App\Repositories\Eloquent;

use DB;
use App\Models\Permission;
use App\Models\Businesses;
use App\Models\TipsSetting;
use App\Models\AdminUser;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\TipsSettingRepository as TipsSettingRepositoryInterface;

/**
 * Class MenuRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class TipsSettingRepositoryEloquent extends BaseRepository implements TipsSettingRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TipsSetting::class;
//        return Businesses::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * 获取商家列表  树形
     * @param string  $condition [description]
     * @param array   $columns   [description]
     * @param bool    $is_need   [是否需要button]
     * @return [type]            [description]
     */
    public function getAll($columns = ['*'], $is_need = true)
    {
//        $columns = [
//            "0" => "cy_tips_setting.*",
//            "1" => "cy_businesses.name",
//        ];
        $res = $this->model->leftJoin('cy_businesses','cy_tips_setting.id','=','cy_businesses.id')->get($columns)->toArray();

        if($is_need){
            foreach ($list as $key => $value) {
                $list[$key]['button'] = $this->model->getActionButtons('tipssetting', $value['id'], true);
            }
        }
        return $list;
    }



    public function ajaxIndex($request)
    {
        $columns = [
            "0" => "cy_tips_setting.*",
            "1" => "cy_businesses.name"
        ];

        $draw            = $request->input('draw',1);
        $start           = $request->input('start',0);
        $length          = $request->input('length',10);
        $order['name']   = $request->input('columns.' .$request->input('order.0.column') . '.name');
        $order['dir']    = $request->input('order.0.dir','asc');
        $search['value'] = $request->input('search.value','');
        $search['regex'] = $request->input('search.regex',false);

        if ($search['value']){
            $keywords = "%{$search['value']}%";
            $kyewordsValue = "{$search['value']}";
            if ($search['regex'] == 'true'){
                $this->model = $this->model->leftJoin('cy_businesses','cy_tips_setting.id','=','cy_businesses.id')
                    ->whereRaw('(name like ?)',[$keywords]);
            }else{
                $this->model = $this->model->leftJoin('cy_businesses','cy_tips_setting.id','=','cy_businesses.id')
                    ->whereRaw('(name = ?)',[$kyewordsValue]);
            }
        }else{
            $this->model = $this->model->leftJoin('cy_businesses','cy_tips_setting.id','=','cy_businesses.id');
        }
        $count = $this->model->count();
        $this->model = $this->model->orderBy($order['name'],$order['dir']);
//        $this->model = $this->model->offset($start)->limit($length)->get($columns);
        $this->model = $this->model->offset($start)->limit($length)->get();

        $tipstype    = getsTipsType();
        $smailflag   = getsSmileFlag();

        if ($this->model) {
            foreach ($this->model as $item) {
                $item->cts_create_time = ($item->cts_create_time)?date('Y-m-d H:i:s',$item->cts_create_time):'';//创建时间
                $item->cts_update_time = ($item->cts_update_time)?date('Y-m-d H:i:s',$item->cts_update_time):'';//更新时间
                $item->cts_type=$tipstype[$item->cts_type];
                $item->cts_smileflag=$smailflag[$item->cts_smileflag];
                $item->button = $item->getActionButtons('tipssetting', '', true);
            }
        }


//        $this->model = $this->sortList($this->model->toArray());

        return [
            'draw'              =>$draw,
            'recordsTotal'      =>$count,
            'recordsFiltered'   =>$count,
            'data'              =>$this->model
        ];
    }

    public function editViewData($id)
    {
        $tipssetting = $this->find($id, ['*']);
        if ($tipssetting) {
            return $tipssetting;
        }
        abort(404);
    }

    public function getBusName($id)
    {
        $businessesname = DB::table('cy_businesses')->where('id',$id)->value('name');
        if ($businessesname) {
            return $businessesname;
        }
        else{
            return '';
        }
        abort(404);
    }
    /**
     * 添加新商户打赏设置
     */
    public function createTipsSetting(array $attr)
    {
        $tipssettingModel                   = new TipsSetting();
        $tipssettingModel->id               = $attr['id'];
        $tipssettingModel->cts_type         = $attr['cts_type'];
        $tipssettingModel->cts_smileflag    = $attr['cts_smileflag'];
        $tipssettingModel->cts_smilerate    = $attr['cts_smilerate'];
        $tipssettingModel->cts_smilemin     = $attr['cts_smilemin'];
        $tipssettingModel->cts_def_amount   = $attr['cts_def_amount'];
        $tipssettingModel->cts_memo         = $attr['cts_memo'];
        $tipssettingModel->cts_create_time  = time();
        $tipssettingModel->cts_create_user  = auth('admin')->user()->name;
        $tipssettingModel->save();
        flash('商户打赏设置新增成功', 'success');
    }

    /**
     * [updateTipsSetting description]
     * @param  array  $attr [description]
     * @param  [type] $id   [description]
     * @return [type]       [description]
     */
     public function updateTipsSetting(array $attr, $id)
    {
        $attr['cts_update_time'] =  time();
        $attr['cts_update_user'] =  auth('admin')->user()->name;
        $res = $this->update($attr, $id);


        if ($res) {
            flash('修改成功!', 'success');
        } else {
            flash('修改失败!', 'error');
        }
        return $res;
    }


}
