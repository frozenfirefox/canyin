<?php

namespace App\Repositories\Eloquent;

use DB;
use App\Models\Permission;
use App\Models\Businesses;
use App\Models\Tips;
use App\Models\AdminUser;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\TipsRepository as TipsRepositoryInterface;

/**
 * Class MenuRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class TipsRepositoryEloquent extends BaseRepository implements TipsRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Tips::class;
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
//            "0" => "cy_tips.*",
//            "1" => "cy_businesses.name",
//        ];
        $res = $this->model->leftJoin('cy_businesses','cy_tips.ct_bus_id','=','cy_businesses.id')->get($columns)->toArray();

        if($is_need){
            foreach ($list as $key => $value) {
                $list[$key]['button'] = $this->model->getActionButtons('tips', $value['id'], true);
            }
        }
        return $list;
    }



    public function ajaxIndex($request)
    {
        $columns = [
            "0" => "cy_tips.*",
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
                $this->model = $this->model->leftJoin('cy_businesses','cy_tips.ct_bus_id','=','cy_businesses.id')
                    ->whereRaw('(ct_status <> 9 and (name like ?))',[$keywords]);
            }else{
                $this->model = $this->model->leftJoin('cy_businesses','cy_tips.ct_bus_id','=','cy_businesses.id')
                    ->whereRaw('(ct_status <> 9 and (name = ?))',[$kyewordsValue]);
            }
        }else{
            $this->model = $this->model->leftJoin('cy_businesses','cy_tips.ct_bus_id','=','cy_businesses.id')
                ->whereRaw('(ct_status <> 9)');
        }
        $count = $this->model->count();
        $this->model = $this->model->orderBy('cy_tips.'.$order['name'],$order['dir']);
        $this->model = $this->model->offset($start)->limit($length)->get($columns);

        $tipstarget    = getTipsTarget();
        $paytype   = getPayType();
        $tipsstatus   = getTipsStatus();

        if ($this->model) {
            foreach ($this->model as $item) {
                $item->ct_create_time = ($item->ct_create_time)?date('Y-m-d H:i:s',$item->ct_create_time):'';//创建时间
                $item->ct_target=$tipstarget[$item->ct_target];
                $item->ct_paytype=$paytype[$item->ct_paytype];
                $item->ct_status=$tipsstatus[$item->ct_status];
                $user = DB::table('cy_staff')
                    ->leftJoin('admins','admins.id','=','cy_staff.user_id')
                    ->where('cy_staff.id',$item->ct_tuser_id)->value('admins.name');
                $item->ct_tuser =  ($user)?$user:'';//获取用户名
                $item->button = $item->getActionButtons('tips', '', true);
            }
        }

        return [
            'draw'              =>$draw,
            'recordsTotal'      =>$count,
            'recordsFiltered'   =>$count,
            'data'              =>$this->model
        ];
    }

    public function editViewData($id)
    {
        $tips = $this->find($id, ['*']);
        if ($tips) {
            return $tips;
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

    public function getUserName($id)
    {
        $user = DB::table('cy_staff')
            ->leftJoin('admins','admins.id','=','cy_staff.user_id')
            ->where('cy_staff.id',$id)->value('admins.name');
        $username = ($user)?$user:'';
        if ($username) {
            return $username;
        }
        else{
            return '';
        }
        abort(404);
    }

    /**
     * [updateTips description]
     * @param  array  $attr [description]
     * @param  [type] $id   [description]
     * @return [type]       [description]
     */
     public function updateTips(array $attr, $id)
    {
        $res = $this->update($attr, $id);


        if ($res) {
            flash('修改成功!', 'success');
        } else {
            flash('修改失败!', 'error');
        }
        return $res;
    }


}
