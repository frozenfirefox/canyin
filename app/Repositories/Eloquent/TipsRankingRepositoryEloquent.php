<?php

namespace App\Repositories\Eloquent;

use DB;
use App\Models\Permission;
use App\Models\TipsRanking;
use App\Models\AdminUser;
use App\Models\Tips;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\TipsRankingRepository as TipsRankingRepositoryInterface;

/**
 * Class MenuRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class TipsRankingRepositoryEloquent extends BaseRepository implements TipsRankingRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TipsRanking::class;
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
    public function getAll($condition = 1, $columns = ['*'], $is_need = true)
    {
        $res = $this->model->whereRaw('status <> 9 and '.$condition)->get($columns)->toArray();

        $list = $this->sortList($res);
        if($is_need){
            foreach ($list as $key => $value) {
                $list[$key]['button'] = $this->model->getActionButtons('tipsranking','', true);
            }
        }

        return $list;

    }

    protected function sortList(array $data, $id = 0, &$arr = [])
    {
        foreach ($data as $v) {
            if ($id == $v['parent_id']) {
                $arr[] = $v;
                $this->sortList($data, $v['id'], $arr);
            }
        }
        return $arr;
    }


    public function ajaxIndex($request)
    {
        $draw            = $request->input('draw',1);
        $start           = $request->input('start',0);
        $dash            = $request->input('is_dash', 0);
        $length          = $request->input('length',10);
        $order['name']   = $request->input('columns.' .$request->input('order.0.column') . '.name');
        $order['dir']    = $request->input('order.0.dir','asc');
        $search['value'] = $request->input('search.value','');
        $search['regex'] = $request->input('search.regex',false);

        $con_status = ($dash)?'status = 9':'status <> 9';

        if ($search['value']){
            $keywords = "%{$search['value']}%";
            $kyewordsValue = "{$search['value']}";
            if ($search['regex'] == 'true'){
                $this->model = $this->model->whereRaw('('.$con_status.' and (name like ? or description like ?))',[$keywords, $keywords]);
            }else{
                $this->model = $this->model->whereRaw('('.$con_status.'and (name = ? or description = ?))',[$kyewordsValue, $kyewordsValue]);
            }
        }else{
            $this->model = $this->model->whereRaw($con_status);
        }

        $count = $this->model->count();
        $this->model = $this->model->orderBy($order['name'],$order['dir']);
        $this->model = $this->model->offset($start)->limit($length)->get();

        if ($this->model) {
            foreach ($this->model as $item) {
                $item->create_time = ($item->create_time)?date('Y-m-d H:i:s',$item->create_time):'';//创建时间
                $item->update_at = ($item->update_at)?date('Y-m-d H:i:s',$item->update_at):'';//更新时间
                $username = DB::table('admins')->where('id',$item->user_id)->select(['name'])->first();
                $item->manage_name =  ($username)?$username->name:'';//经理姓名


                $item->button = $item->getActionButtons('tipsranking', '', true);
                $item->DT_RowId = $item->id;
                $item->pId = $item->id;
                $item->turnover = '<span style="color:#164928;">'.$item->turnover.' </span>万';
                $status = getsBusStatus();
                $item->status = '<a id="status_id_'.$item->id.'" class="btn btn-success bus-status btn-xs" @click="update_status('.$item->id.', \'#status_id_'.$item->id.'\')" data-bus="'.$item->id.'" data-status="'.$item->status.'">'.$status[$item->status].'</a>';

            }
        }

        //如果是回收站就不进行tree了
        if(!$dash){
            $this->model = $this->sortList($this->model->toArray());
        }else{
            $this->model = $this->model->toArray();
        }

        return [
            'draw'              =>$draw,
            'recordsTotal'      =>$count,
            'recordsFiltered'   =>$count,
            'data'              =>$this->model
        ];
    }


    public function ajax_waiter($request)
    {
        $draw            = $request->input('draw',1);
        $bid             = $request->input('bid', 0);
        $start           = $request->input('start',0);
        $dash            = $request->input('is_dash', 0);
        $length          = $request->input('length',10);
        $order['name']   = $request->input('columns.' .$request->input('order.0.column') . '.name');
        $order['dir']    = $request->input('order.0.dir','asc');
        $search['value'] = $request->input('search.value','');
        $search['regex'] = $request->input('search.regex',false);

        $count = 10;


        $time = date('Y-m-d', time());
        $temp_time=strtotime($time." -1 month");
        $res = DB::table('cy_tips')
            ->select('admins.name as name',DB::raw('COUNT(*) as ranking'))
            ->leftJoin('cy_staff','cy_staff.id','=','ct_tuser_id')
            ->leftJoin('admins','admins.id','=','cy_staff.user_id')
            ->whereRaw('(ct_status <> 9 and ct_target = 3 and ct_bus_id = ? and ct_create_time >= ?)',[$bid,$temp_time])
            ->groupBy('admins.name')
            ->orderBy('ranking','desc')
            ->skip(0)->take(10)->get();

        return [
            'draw'              =>$draw,
            'recordsTotal'      =>$count,
            'recordsFiltered'   =>$count,
            'data'              =>$res
        ];
    }

    public function ajax_chef($request)
    {
        $draw            = $request->input('draw',1);
        $bid             = $request->input('bid', 0);
        $start           = $request->input('start',0);
        $dash            = $request->input('is_dash', 0);
        $length          = $request->input('length',10);
        $order['name']   = $request->input('columns.' .$request->input('order.0.column') . '.name');
        $order['dir']    = $request->input('order.0.dir','asc');
        $search['value'] = $request->input('search.value','');
        $search['regex'] = $request->input('search.regex',false);

        $count = 10;


        $time = date('Y-m-d', time());
        $temp_time=strtotime($time." -1 month");
        $res = DB::table('cy_tips')
            ->select('admins.name as name',DB::raw('COUNT(*) as ranking'))
            ->leftJoin('cy_staff','cy_staff.id','=','ct_tuser_id')
            ->leftJoin('admins','admins.id','=','cy_staff.user_id')
            ->whereRaw('(ct_status <> 9 and ct_target = 4 and ct_bus_id = ? and ct_create_time >= ?)',[$bid,$temp_time])
            ->groupBy('admins.name')
            ->orderBy('ranking','desc')
            ->skip(0)->take(10)->get();

        return [
            'draw'              =>$draw,
            'recordsTotal'      =>$count,
            'recordsFiltered'   =>$count,
            'data'              =>$res
        ];
    }

    public function ajax_goods($request)
    {
        $draw            = $request->input('draw',1);
        $bid             = $request->input('bid', 0);
        $start           = $request->input('start',0);
        $dash            = $request->input('is_dash', 0);
        $length          = $request->input('length',10);
        $order['name']   = $request->input('columns.' .$request->input('order.0.column') . '.name');
        $order['dir']    = $request->input('order.0.dir','asc');
        $search['value'] = $request->input('search.value','');
        $search['regex'] = $request->input('search.regex',false);

        $count = 10;


        $time = date('Y-m-d', time());
        $temp_time=strtotime($time." -1 month");
        $res = DB::table('cy_tips')
            ->select('cy_goods.goods_name as name',DB::raw('COUNT(*) as ranking'))
            ->leftJoin('cy_order_goods','cy_order_goods.id','=','ct_food_id')
            ->leftJoin('cy_goods','cy_goods.id','=','cy_order_goods.goods_id')
            ->whereRaw('(ct_status <> 9 and ct_target = 1 and ct_bus_id = ? and ct_create_time >= ?)',[$bid,$temp_time])
            ->groupBy('cy_goods.goods_name')
            ->orderBy('ranking','desc')
            ->skip(0)->take(10)->get();

        return [
            'draw'              =>$draw,
            'recordsTotal'      =>$count,
            'recordsFiltered'   =>$count,
            'data'              =>$res
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



}