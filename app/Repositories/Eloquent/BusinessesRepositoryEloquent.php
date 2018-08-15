<?php

namespace App\Repositories\Eloquent;

use DB;
use App\Models\Permission;
use App\Models\Businesses;
use App\Models\AdminUser;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\BusinessesRepository as BusinessesRepositoryInterface;

/**
 * Class MenuRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class BusinessesRepositoryEloquent extends BaseRepository implements BusinessesRepositoryInterface
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
                $list[$key]['button'] = $this->model->getActionButtons('businesses', $value['id'], true);
            }
        }

        return $list;

    }

    /**
     * 排序
     * @param array     $data   需要循环的数组
     * @param int       $id     获取id为$id下的子分类，0为所有分类
     * @param array     $arr    将获取到的数据暂时存储的数组中，方便数据返回
     * @return array            二维数组
     */
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

                $item->dash         = $dash;//是否为回收站 删除
                if($dash){
                    $item->button   = $item->getActionButtons('busdash');
                    $status = getsBusStatus();
                    $item->status = '<a id="status_id_'.$item->id.'" class="btn btn-info bus-status btn-xs">'.$status[$item->status].'</a>';
                }else{
                    $item->button = $item->getActionButtons('businesses', '', true);
                    $item->DT_RowId = $item->id;
                    $item->pId = $item->id;
                    $item->turnover = '<span style="color:#164928;">'.$item->turnover.' </span>万';
                    $status = getsBusStatus();
                    $item->status = '<a id="status_id_'.$item->id.'" class="status_class btn btn-success bus-status btn-xs"  data-bus="'.$item->id.'" data-status="'.$item->status.'">'.$status[$item->status].'</a>';
                }

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
        $businesses = $this->find($id, ['*']);
        if ($businesses) {
            return $businesses;
        }
        abort(404);
    }

    /**
     * 添加新商户
     */
    public function createBusinesses(array $attr)
    {
        $businessesModel                = new Businesses();
        $businessesModel->name          = $attr['name'];
        $businessesModel->turnover      = $attr['turnover'];
        $businessesModel->phone         = $attr['phone'];
        $businessesModel->address       = $attr['address'];
        $businessesModel->user_id       = $attr['user_id'];
        $businessesModel->description   = $attr['description'];
        $businessesModel->tag           = $attr['tag'];
        $businessesModel->parent_id     = $attr['parent_id'];
        $businessesModel->create_time   = time();

        $businessesModel->save();
        flash('商户新增成功', 'success');
    }

    /**
     * [updateBusinesses description]
     * @param  array  $attr [description]
     * @param  [type] $id   [description]
     * @return [type]       [description]
     */
     public function updateBusinesses(array $attr, $id)
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
