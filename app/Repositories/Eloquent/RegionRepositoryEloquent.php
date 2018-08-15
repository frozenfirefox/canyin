<?php

namespace App\Repositories\Eloquent;

use DB;
use App\Models\Permission;
use App\Models\Region;
use App\Models\AdminUser;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\RegionRepository as RegionRepositoryInterface;

/**
 * Class MenuRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class RegionRepositoryEloquent extends BaseRepository implements RegionRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Region::class;
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
        $draw            = $request->input('draw', 1);
        $start           = $request->input('start', 0);
        $pid             = $request->input('pid', 0);
        $length          = $request->input('length', 10);
        $order['name']   = $request->input('columns.' .$request->input('order.0.column') . '.name', 'id');
        $order['dir']    = $request->input('order.0.dir', 'asc');
        $search['value'] = $request->input('search.value', '');
        $search['regex'] = $request->input('search.regex', false);

        $con_status = 'parent_id = '.$pid;

        if ($search['value']){
            $keywords = "%{$search['value']}%";
            $kyewordsValue = "{$search['value']}";
            if ($search['regex'] == 'true'){
                $this->model = $this->model->whereRaw('('.$con_status.' and (region_name like ? or id like ?))',[$keywords, $keywords]);
            }else{
                $this->model = $this->model->whereRaw('('.$con_status.' and (region_name = ? or id = ?))',[$kyewordsValue, $kyewordsValue]);
            }
        }else{
            $this->model = $this->model->whereRaw($con_status);
        }

        $count = $this->model->count();
        $this->model = $this->model->orderBy($order['name'],$order['dir']);
        $this->model = $this->model->offset($start)->limit($length)->get();

        if ($this->model) {
            foreach ($this->model as $item) {
                $item->create_time      = ($item->create_time)?date('Y-m-d H:i:s',$item->create_time):'';//创建时间
                $item->update_at        = ($item->update_at)?date('Y-m-d H:i:s',$item->update_at):'';//更新时间
                $item->belong_area_name = getArea($item->belong_area_id);
                switch($item->region_type){
                    case 2:
                        $item->button       = '<a href="javascript:;" class="region_district" data-data="'. $item->region_name .'" data-id="'. $item->id .'">查看市区</a>';
                    break;
                    case 3:
                        $item->button       = '<a href="javascript:;" class="region_streets" data-data="'. $item->region_name .'" data-id="'. $item->id .'">查看街道</a>';
                    break;
                    default:
                    break;
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

    /**
     * 根据市id获取街道信息
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getStreetByPid($pid){
        $data  =  DB::table('cy_street')->where('parent_id', '=', $pid)->get();
        foreach($data as $v){
            switch($v->status){
                case 9:
                    $v->status = '删除';
                break;
                case 0:
                    $v->status = '禁用';
                break;
                default:
                    $v->status = '正常';
                break;
            }
        }
        $data_arr = json_decode(json_encode($data), true);

        return $data;
    }

    public function editViewData($id)
    {

        $Region = $this->find($id, ['*']);
        if ($Region) {
            return $Region;
        }
        abort(404);
    }
    /**
     * 添加新商户
     */
    public function createRegion(array $attr)
    {
        $RegionModel                =  new Region();
        $RegionModel->name          = $attr['name'];
        $RegionModel->size          = $attr['size'];
        $RegionModel->ext           = $attr['ext'];
        $RegionModel->md5           = $attr['md5'];
        $RegionModel->sha1          = $attr['sha1'];
        $RegionModel->mime          = $attr['mime'];
        $RegionModel->savename      = $attr['savename'];
        $RegionModel->savepath      = $attr['savepath'];
        $RegionModel->location      = $attr['location'];
        $RegionModel->path          = $attr['path'];
        $RegionModel->abs_url       = $attr['abs_url'];
        $RegionModel->oss_path      = $attr['oss_path'];
        $RegionModel->create_time   = time();
        $RegionModel->save();
        flash('消息新增成功', 'success');

        return $RegionModel->id;
    }

    /**
     * [updateBusinesses description]
     * @param  array  $attr [description]
     * @param  [type] $id   [description]
     * @return [type]       [description]
     */
     public function updateRegion(array $attr, $id)
    {

        $attr['create_time'] = time();
        $res = $this->update($attr, $id);

        if ($res) {
            flash('修改成功!', 'success');
        } else {
            flash('修改失败!', 'error');
        }
        return $res;
    }


    public  function arrLocation(){

        $arr_location = [
            0 => '本地',
            1 => '其它'
        ];
        return $arr_location;
    }

}
