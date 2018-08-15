<?php

namespace App\Repositories\Eloquent;

use DB;
use App\Models\Permission;
use App\Models\TipsSim;
use App\Models\Businesses;
use App\Models\AdminUser;
use App\Models\Tips;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\TipsSimRepository as TipsSimRepositoryInterface;

/**
 * Class MenuRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class TipsSimRepositoryEloquent extends BaseRepository implements TipsSimRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Businesses::class;
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
                $list[$key]['button'] = $this->model->getActionButtons('tipssim','', true);
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

        $sql='SELECT id as bid,ifnull(ocount,0) as ocount,ifnull(tcount,0) as tcount FROM cy_businesses left join (select merchant_id as mid,count(*) as ocount from cy_order where order_status <> 9 group by merchant_id) o on o.mid = cy_businesses.id left join (select ct_bus_id as mid,count(*) as tcount from cy_tips where ct_status <> 9 group by ct_bus_id) t on t.mid = cy_businesses.id';
        $orderby = ' Order by '.$order['name'].' '.$order['dir'].' ';
        $limit = ' limit '.$start.','.$length;

        $keywords = "";
        if ($search['value']){
            $keywords = "%{$search['value']}%";
            $kyewordsValue = "{$search['value']}";
            if ($search['regex'] == 'true'){
                $this->model = $this->model->whereRaw('('.$con_status.' and (name like ? or description like ?))',[$keywords, $keywords]);

//                $keywords = "%{$search['value']}%";
//                $where = ' WHERE (status <> 9 and (name like ? or description like ?)) ';
//                $query = DB::select($sql.$where.$orderby.$limit,[$keywords, $keywords]);
            }else{
                $this->model = $this->model->whereRaw('('.$con_status.'and (name = ? or description = ?))',[$kyewordsValue, $kyewordsValue]);

//                $keywords = "{$search['value']}";
//                $where = ' WHERE (status <> 9 and (name =? or description =?)) ';
//                $query = DB::select($sql.$where.$orderby.$limit,[$keywords, $keywords]);
            }
        }else{
            $this->model = $this->model->whereRaw($con_status);

//            $where = ' WHERE status <> 9 ';
//            $query = DB::select($sql.$where.$orderby.$limit);
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
                $item->button = $item->getActionButtons('tipssim', '', true);
                $item->DT_RowId = $item->id;
                $item->pId = $item->id;
                $item->turnover = '<span style="color:#164928;">'.$item->turnover.' </span>万';
                $status = getsBusStatus();
                $item->status = '<a id="status_id_'.$item->id.'" class="btn btn-success bus-status btn-xs" @click="update_status('.$item->id.', \'#status_id_'.$item->id.'\')" data-bus="'.$item->id.'" data-status="'.$item->status.'">'.$status[$item->status].'</a>';

//                if (!empty($item->ocount)&&$item->ocount!=0&&!empty($item->tcount)){
//                    $item->rate=strval((float)$item->tcount/$item->ocount*100).'%';
//                }
//                else{
//                    $item->rate=0;
//                }

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

    public function getStaff($id)
    {
        $staff = DB::table('cy_staff')
            ->select('cy_staff.id as id','admins.name as name')
            ->leftJoin('admins','admins.id','=','cy_staff.user_id')
            ->whereRaw('(cy_staff.status <> 9 and businesses_id = ?)',[$id])->get();
        return $staff;
    }

    public function getAmount($id)
    {
        $amount = DB::table('cy_tips_setting')->where('id',$id)->value('cts_def_amount');
        if ($amount) {
            $amount = explode(",", $amount);
            if (count($amount)<1){
                $amount=array('1.00','5.00','10.00','20.00','30.00','50.00');
            }
            return $amount;
        }
        else
        {
            $amount=array('1.00','5.00','10.00','20.00','30.00','50.00');
            return $amount;
        }
        abort(404);
    }


    /**
     * 添加模拟打赏
     */
    public function createTipsSim(array $postdata)
    {
        $TipsSimModel                     = new TipsSim();
        $TipsSimModel->ct_user_id         = $postdata['ct_user_id'];
        $TipsSimModel->ct_qrcode          = $postdata['ct_qrcode'];
        $TipsSimModel->ct_bus_id          = $postdata['ct_bus_id'];
        $TipsSimModel->ct_tuser_id        = $postdata['ct_tuser_id'];
        $TipsSimModel->ct_order_id        = $postdata['ct_order_id'];
        $TipsSimModel->ct_food_id         = $postdata['ct_food_id'];
        $TipsSimModel->ct_target          = $postdata['ct_target'];
        $TipsSimModel->ct_paytype         = $postdata['ct_paytype'];
        $TipsSimModel->ct_amount          = $postdata['ct_amount'];
        $TipsSimModel->ct_memo            = $postdata['ct_memo'];
        $TipsSimModel->ct_status          = 0;
        $TipsSimModel->ct_create_time     = time();
        $TipsSimModel->save();
        flash('模拟打赏成功', 'success');
    }
}