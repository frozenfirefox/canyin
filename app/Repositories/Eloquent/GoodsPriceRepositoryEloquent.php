<?php

namespace App\Repositories\Eloquent;

use DB;
use App\Models\Permission;
use App\Models\GoodsPrice;
use App\Models\AdminUser;
use App\Models\Classes;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\GoodsPriceRepository as GoodsPriceRepositoryInterface;

/**
 * Class MenuRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class GoodsPriceRepositoryEloquent extends BaseRepository implements GoodsPriceRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return GoodsPrice::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @description 根据条件查询数据  带有排序
     * @param  $condition string [字符窜 类似 id = 1 and row = 2 ....]
     * @param  $order [array] [必须是 [['id','asc'],....] 是一个二维数组]
     * @return [type] [array] [返回数组]
     */
    public function getList($condition , $order = []){
        $this->model->whereRaw('status <> 9 and '.$condition);
        if($order){
            foreach ($order as $value) {
                $this->model->orderBy($value[0], $value[1]);
            }
        }
        $data = $this->model->get()->toArray();
        // if($data){
        //     foreach ($data as &$item) {
        //         //查询到商品名称
        //         $goodsname          = DB::table('cy_goods')->where('id', $item['goods_id'])->select(['goods_name'])->first();
        //         $item['goods_name']   = ($goodsname)?$goodsname->goods_name:'';//商品名
        //     }
        // }
        return $data;
    }

    public function ajaxIndex($request)
    {
        $draw            = $request->input('draw',1);
        $gid             = $request->input('gid', 0);
        $start           = $request->input('start',0);
        $length          = $request->input('length',10);
        $order['name']   = $request->input('columns.' .$request->input('order.0.column') . '.name');
        $order['dir']    = $request->input('order.0.dir','asc');
        $search['value'] = $request->input('search.value','');
        $search['regex'] = $request->input('search.regex',false);

        if ($search['value']){
            $namelike = "%{$search['value']}%";
            $nameValue = "{$search['value']}";
            if ($search['regex'] == 'true'){
                $this->model = $this->model->whereRaw('(status <> 9 and goods_id = ? and (goods_specification like ?))',[$gid, $namelike]);
            }else{
                $this->model = $this->model->whereRaw('(status <> 9 and goods_id = ? and (goods_specification = ? or keyword = ?))',[$gid, $nameValue]);
            }
        }else{
            $this->model = $this->model->whereRaw('status <> 9 and goods_id = '.$gid);
        }

        $count = $this->model->count();
        $this->model = $this->model->orderBy($order['name'],$order['dir']);
        $this->model = $this->model->offset($start)->limit($length)->get();

        if ($this->model) {
            foreach ($this->model as $item) {
                $item->create_at  = toDate($item->create_at, '-', true);//创建时间
                $item->update_at  = toDate($item->update_at, '-', true);//更新时间
                $item->button       = $item->getActionButtons('goodsprice', '', true);
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
    public function createGoodsPrice(array $attr)
    {
        $goodsPriceModel                        = new GoodsPrice();
        $goodsPriceModel->goods_id              = $attr['goods_id'];
        $goodsPriceModel->goods_specification   = $attr['goods_specification'];
        $goodsPriceModel->settlement_price      = $attr['settlement_price'];
        $goodsPriceModel->shop_price            = $attr['shop_price'];
        $goodsPriceModel->market_price          = $attr['market_price'];
        $goodsPriceModel->goods_weight          = $attr['goods_weight'];
        $goodsPriceModel->wy_price              = $attr['wy_price'];
        $goodsPriceModel->yx_price              = $attr['yx_price'];
        $goodsPriceModel->integral              = $attr['integral'];
        $goodsPriceModel->discount              = $attr['discount'];
        $goodsPriceModel->red_rurn_integral     = $attr['red_rurn_integral'];
        $goodsPriceModel->yellow_discount       = $attr['yellow_discount'];
        $goodsPriceModel->yellow_return_integral= $attr['yellow_return_integral'];
        $goodsPriceModel->blue_discount         = $attr['blue_discount'];
        $goodsPriceModel->goods_img             = $attr['goods_img'];
        $goodsPriceModel->goods_attr            = $attr['goods_attr'];
        $goodsPriceModel->create_at             = time();
        $goodsPriceModel->save();
        flash('产品价格添加成功', 'success');
        return $goodsPriceModel->id;
    }

    /**
     * [updateGoodsPrice description]
     * @param  array  $attr [description]
     * @param  [type] $id   [description]
     * @return [type]       [description]
     */
     public function updateGoodsPrice(array $attr, $id)
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
