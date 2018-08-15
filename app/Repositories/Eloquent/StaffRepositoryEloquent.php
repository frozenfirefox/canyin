<?php

namespace App\Repositories\Eloquent;

use DB;
use App\Models\Permission;
use App\Models\Staff;
use App\Models\AdminUser;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\StaffRepository as StaffRepositoryInterface;

/**
 * Class MenuRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class StaffRepositoryEloquent extends BaseRepository implements StaffRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Staff::class;
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
        $bid             = $request->input('bid', 0);
        $dash            = $request->input('is_dash', 0);
        $start           = $request->input('start',0);
        $length          = $request->input('length',10);
        $order['name']   = $request->input('columns.' .$request->input('order.0.column') . '.name');
        $order['dir']    = $request->input('order.0.dir','asc');
        $search['value'] = $request->input('search.value','');
        $search['regex'] = $request->input('search.regex',false);
        $con_status = ($dash)?'status = 9':'status <> 9';

        if ($search['value']){
            $keywords = "%{$search['value']}%";
            $kyewordsValue = "{$search['value']}";
            $phonelike = "%{$search['value']}%";
            $phoneValue = "{$search['value']}";
            if ($search['regex'] == 'true'){
                $this->model = $this->model->whereRaw('('.$con_status.' and (phone like ? or description like ?))',[ $bid, $phonelike, $keywords]);
            }else{
                $this->model = $this->model->whereRaw('('.$con_status.' and (phone = ? or description = ?))',[$bid, $phoneValue, $kyewordsValue]);
            }
        }else{
            $this->model = $this->model->whereRaw($con_status);
        }

        $count = $this->model->count();
        $this->model = $this->model->orderBy($order['name'],$order['dir']);
        $this->model = $this->model->offset($start)->limit($length)->get();

        if ($this->model) {
            foreach ($this->model as $item) {
                $item->create_at = ($item->create_at)?date('Y-m-d H:i:s',$item->create_at):'';//创建时间
                $item->update_at = ($item->update_at)?date('Y-m-d H:i:s',$item->update_at):'';//更新时间
                $username = DB::table('admins')->where('id',$item->user_id)->select(['name'])->first();
                $item->name =  ($username)?$username->name:'';//经理姓名
                $businessesName = DB::table('cy_businesses')->where('id',$item->businesses_id)->select(['name'])->first();
                $item->businesses_name =  ($businessesName)?$businessesName->name:'';//获取商户name

                $item->dash         = $dash;//是否为回收站 删除
                if($dash){
                    $item->button   = $item->getActionButtons('staffdash');
                }else{
                    $item->button   = $item->getActionButtons('staff', '', true);
                }
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
        $staff = $this->find($id);
        if ($staff) {
            return $staff;
        }
        abort(404);
    }
    public function getList($condition,$bid){
        return $this->model->whereRaw('status <> 9 and '.$condition.'='.$bid)->get()->toArray();
    }

    /**
     * 添加新商户
     */
    public function createStaff(array $attr)
    {
        $staffModel                = new Staff();
        $staffModel->user_id       = $attr['user_id'];
        $staffModel->phone         = $attr['phone'];
        $staffModel->businesses_id = $attr['businesses_id'];
        $staffModel->position      = $attr['position'];
        $staffModel->parent_id     = $attr['parent_id'];
        $staffModel->description   = $attr['description'];
        $staffModel->create_at     = time();

        $staffModel->save();
        flash('员工新增成功', 'success');
    }

    /**
     * [updateStaff description]
     * @param  array  $attr [description]
     * @param  [type] $id   [description]
     * @return [type]       [description]
     */
     public function updateStaff(array $attr, $id)
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
}
