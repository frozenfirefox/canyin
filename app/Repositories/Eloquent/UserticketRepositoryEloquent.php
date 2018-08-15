<?php

namespace App\Repositories\Eloquent;

use DB;
use App\Models\Permission;
use App\Models\Userticket;
use App\Models\AdminUser;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\UserticketRepository as UserticketRepositoryInterface;

/**
 * Class MenuRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class UserticketRepositoryEloquent extends BaseRepository implements UserticketRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Userticket::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function ajaxIndex($request)
    {
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
                $this->model = $this->model->whereRaw('(status <> 9 and (ticket_id like ? or user_id like ?))',[$keywords, $keywords]);
            }else{
                $this->model = $this->model->whereRaw('(status <> 9 and (ticket_id = ? or user_id = ?))',[$kyewordsValue, $kyewordsValue]);
            }
        }else{
            $this->model = $this->model->whereRaw('status <> 9');
        }

        $count = $this->model->count();
        $this->model = $this->model->orderBy($order['name'],$order['dir']);
        $this->model = $this->model->offset($start)->limit($length)->get();

        if ($this->model) {
            foreach ($this->model as $item) {

                $arr_status = [
                    0 => '未使用',
                    1 => '已使用'
                ];
                $item->status       = $arr_status[$item->status ];
                $item->create_time  = ($item->create_time)?date('Y-m-d H:i:s',$item->create_time):'';//创建时间
                $item->update_at    = ($item->update_at)?date('Y-m-d H:i:s',$item->update_at):'';//更新时间
                $username = DB::table('admins')->where('id',$item->user_id)->select(['name'])->first();
                $item->manage_name =  ($username)?$username->name:'';//消息标题
                $item->button = $item->getActionButtons('userticket', '', true);
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
        $userticket = $this->find($id, ['id','ticket_id','user_id','status','create_time','update_at']);
        if ($userticket) {
            return $userticket;
        }
        abort(404);
    }


    /**
     * 添加用户优惠劵
     */
    public function createUserticket(array $attr)
    {
        $userticketModel                =  new Userticket();
        $userticketModel->ticket_id     = $attr['ticket_id'];
        $userticketModel->user_id       = $attr['user_id'];
        $userticketModel->status        = $attr['status'];
        $userticketModel->create_time   = time();
        $userticketModel->save();
        flash('用户优惠劵新增成功', 'success');
    }

    /**
     * [updateBusinesses description]
     * @param  array  $attr [description]
     * @param  [type] $id   [description]
     * @return [type]       [description]
     */
     public function updateUserticket(array $attr, $id)
    {
        $attr['update_at'] = time();
        $res = $this->update($attr, $id);

        if ($res) {
            flash('修改成功!', 'success');
        } else {
            flash('修改失败!', 'error');
        }
        return $res;
    }

    public function arrStatus(){
        $arr_status = [
            0 => '未使用',
            1 => '已使用'
        ];
        return $arr_status;
    }



}
