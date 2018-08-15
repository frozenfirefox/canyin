<?php

namespace App\Repositories\Eloquent;

use DB;
use App\Models\Permission;
use App\Models\Classes;
use App\Models\AdminUser;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\ClassesRepository as ClassesRepositoryInterface;

/**
 * Class MenuRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class ClassesRepositoryEloquent extends BaseRepository implements ClassesRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Classes::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * *
     * @param  [string] $condition [description]
     * @return [array]            [description]
     */
    public function getList($condition){
        return $this->model->whereRaw('status <> 9 and '.$condition)->get()->toArray();
    }


    /**
     * 获取类别  树形
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
                $list[$key]['button'] = $this->model->getActionButtons('classes', $value['id'],true);
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
        $bid             = $request->input('bid', 0);
        $dash            = $request->input('is_dash', 0);
        $ctype           = $request->input('ctype', 0);
        $start           = $request->input('start',0);
        $length          = $request->input('length',10);
        $order['name']   = $request->input('columns.' .$request->input('order.0.column') . '.name');
        $order['dir']    = $request->input('order.0.dir','asc');
        $search['value'] = $request->input('search.value','');
        $search['regex'] = $request->input('search.regex',false);

        //先保存下来
        $_this = $this->model;
        $con_status = ($dash)?'status = 9':'status <> 9';
        if ($search['value']){
            $keywords = "%{$search['value']}%";
            $kyewordsValue = "{$search['value']}";
            $namelike = "%{$search['value']}%";
            $nameValue = "{$search['value']}";
            if ($search['regex'] == 'true'){
                $this->model = $this->model->whereRaw('(class_type = ? and '.$con_status.' and parent_id = 0 and businesses_id = ? and (name like ? or description like ?))', [$ctype, $bid, $namelike, $keywords]);
            }else{
                $this->model = $this->model->whereRaw('(class_type = ? and '.$con_status.' and parent_id = 0 and businesses_id = ? and (name = ? or description = ?))', [$ctype, $bid, $nameValue, $kyewordsValue]);
            }
        }else{
            $this->model = $this->model->whereRaw('class_type = ? and '.$con_status.' and parent_id = 0 and businesses_id = '.$bid, [$ctype]);
        }

        $count = $this->model->count();
        $this->model = $this->model->orderBy($order['name'],$order['dir']);
        $this->model = $this->model->offset($start)->limit($length)->get();

        $arr_children = [];

        if ($this->model) {
            foreach ($this->model as $item) {
                $item->create_at = ($item->create_at)?date('Y-m-d H:i:s',$item->create_at):'';//创建时间
                $item->update_at = ($item->update_at)?date('Y-m-d H:i:s',$item->update_at):'';//更新时间
                $businessesName = DB::table('cy_businesses')->where('id',$item->businesses_id)->select(['name'])->first();
                $item->businesses_name =  ($businessesName)?$businessesName->name:'所有商户';//获取商户name
                $item->dash         = $dash;//是否为回收站 删除
                if($dash){
                    $item->button   = $item->getActionButtons('classesdash');
                }else{
                    $item->button   = $item->getActionButtons('classes', '', true);
                }
                $item->status_name = '使用中';
                $item->DT_RowId = $item->id;
                $item->pId = $item->id;
            }
            //为了取下级的
            $arr_children = $_this->whereRaw($con_status.' and class_type = ? and parent_id > 0 and businesses_id = '.$bid, [$ctype])->get();
        }
        if($arr_children){
            foreach ($arr_children as $item) {
                $item->create_at = ($item->create_at)?date('Y-m-d H:i:s',$item->create_at):'';//创建时间
                $item->update_at = ($item->update_at)?date('Y-m-d H:i:s',$item->update_at):'';//更新时间
                $businessesName = DB::table('cy_businesses')->where('id',$item->businesses_id)->select(['name'])->first();
                $item->businesses_name =  ($businessesName)?$businessesName->name:'所有商户';//获取商户name

                $item->dash         = $dash;//是否为回收站 删除
                if($dash){
                    $item->button   = $item->getActionButtons('classesdash');
                }else{
                    $item->button   = $item->getActionButtons('classes', '', true);
                }

                $item->status_name = '使用中';
                $item->DT_RowId = $item->id;
                $item->pId = $item->id;
            }
            $this->model = array_merge($this->model->toArray(), $arr_children->toArray());
        }else{
            $this->model = $this->model->toArray();
        }

        $this->model = $this->sortList($this->model);

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

    /**
     * 添加新商户
     */
    public function createClasses(array $attr)
    {
        $ClassesModel                   = new Classes();
        $ClassesModel->name             = $attr['name'];
        $ClassesModel->class_type       = $attr['class_type'];
        $ClassesModel->parent_id        = $attr['parent_id'];
        $ClassesModel->businesses_id    = $attr['businesses_id'];
        $ClassesModel->description      = $attr['description'];
        $ClassesModel->create_at        = time();

        $ClassesModel->save();
        flash('类别新增成功', 'success');
    }

    /**
     * [updateClasses description]
     * @param  array  $attr [description]
     * @param  [type] $id   [description]
     * @return [type]       [description]
     */
     public function updateClasses(array $attr, $id)
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
