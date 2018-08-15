<?php

namespace App\Repositories\Eloquent;

use DB;
use App\Models\Permission;
use App\Models\GoodsAttr;
use App\Models\AdminUser;
use App\Models\Classes;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\GoodsAttrRepository as GoodsAttrRepositoryInterface;

/**
 * Class MenuRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class GoodsAttrRepositoryEloquent extends BaseRepository implements GoodsAttrRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return GoodsAttr::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


    public function getAttr($condition)
    {
        return $this->model->whereRaw('status <> 9 and '.$condition)->get()->toArray();
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
            $namelike = "%{$search['value']}%";
            $nameValue = "{$search['value']}";
            if ($search['regex'] == 'true'){
                $this->model = $this->model->whereRaw('('.$con_status.'  and (goods_attr_value like ? or goods_attr_id like ?))',[$bid, $namelike, $keywords]);
            }else{
                $this->model = $this->model->whereRaw('('.$con_status.' and (goods_attr_value = ? or goods_attr_id = ?))',[$bid, $nameValue, $kyewordsValue]);
            }
        }else{
            $this->model = $this->model->whereRaw($con_status);
        }

        $count = $this->model->count();
        $this->model = $this->model->orderBy($order['name'],$order['dir']);
        $this->model = $this->model->offset($start)->limit($length)->get();

        if ($this->model) {
            foreach ($this->model as $item) {
                $item->create_time  = toDate($item->create_time, '-', true);//创建时间
                $item->update_time  = toDate($item->update_time, '-', true);//更新时间
                $businesses         = DB::table('cy_businesses')->where('id',$item->businesses_id)->select(['name'])->first();
                $item->businesses_name  =  ($businesses)?$businesses->name:'';//经理姓名
                $classesName        = DB::table('cy_classes')->where('id',$item->classes_type)->select(['name'])->first();
                $item->type_name    = ($classesName)?$classesName->name:'';//获取产品类别

                $item->dash         = $dash;//是否为回收站 删除
                if($dash){
                    $item->button   = $item->getActionButtons('gattrdash');
                }else{
                    $item->button   = $item->getActionButtons('goodsattr', '', true);
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

    /**
     * 添加新商户
     */
    public function createGoodsAttr(array $attr)
    {
        $goodsAttrModel                     = new GoodsAttr();
        $goodsAttrModel->goods_attr_id      = $attr['goods_attr_id'];
        $goodsAttrModel->goods_attr_value   = $attr['goods_attr_value'];
        $goodsAttrModel->businesses_id      = $attr['businesses_id'];
        $goodsAttrModel->classes_type       = $attr['classes_type'];

        $goodsAttrModel->save();

        $id = $goodsAttrModel->id;
        if($id){
            flash('自定义属性新增成功', 'success');
            return $id;
        }else{
            abort(500, '系统错误请联系管理员！');
        }

    }

    /**
     * [updateGoodsAttr description]
     * @param  array  $attr [description]
     * @param  [type] $id   [description]
     * @return [type]       [description]
     */
     public function updateGoodsAttr(array $attr, $id)
    {
        $attr['update_time'] = time();
        $res = $this->update($attr, $id);

        if ($res) {
            flash('修改成功!', 'success');
        } else {
            flash('修改失败!', 'error');
        }
        return $res;
    }
}
