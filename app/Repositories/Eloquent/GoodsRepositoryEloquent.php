<?php

namespace App\Repositories\Eloquent;

use DB;
use App\Models\Permission;
use App\Models\Goods;
use App\Models\AdminUser;
use App\Models\Classes;
use App\Models\Gallery;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\GoodsRepository as GoodsRepositoryInterface;

/**
 * Class MenuRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class GoodsRepositoryEloquent extends BaseRepository implements GoodsRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Goods::class;
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
            $namelike = "%{$search['value']}%";
            $nameValue = "{$search['value']}";
            if ($search['regex'] == 'true'){
                $this->model = $this->model->whereRaw('('.$con_status.'  and (goods_name like ? or keyword like ?))',[$bid, $namelike, $keywords]);
            }else{
                $this->model = $this->model->whereRaw('('.$con_status.'and (goods_name = ? or keyword = ?))',[$bid, $nameValue, $kyewordsValue]);
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
                $username           = DB::table('admins')->where('id',$item->user_id)->select(['name'])->first();
                $item->name         =  ($username)?$username->name:'';//经理姓名
                $classesName        = DB::table('cy_classes')->where('id',$item->goods_typeid)->select(['name'])->first();
                $item->type_name    = ($classesName)?$classesName->name:'';//获取产品类别
                $item->is_refer     = ($item->is_refer == 1)?'是':'否';

                $item->dash         = $dash;//是否为回收站 删除
                if($dash){
                    $item->button   = $item->getActionButtons('goodsdash');
                }else{
                    $item->button   = $item->getActionButtons('goods', '', true);
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

    public function editAllData($content,$id)
    {
        $staff = $this->findByField($content,$id)->Toarray();
        if ($staff) {
            return $staff;
        }
        abort(404);
    }



    /**
     * 添加新商户
     */
    public function createGoods(array $attr)
    {

        $goodsModel                = new Goods();
        $goodsModel->keyword       = $attr['keyword'];
        $goodsModel->goods_name    = $attr['goods_name'];
        $goodsModel->merchant_id   = $attr['businesses_id'];
        $goodsModel->goods_brief   = $attr['goods_brief'];
        $goodsModel->goods_desc    = $attr['goods_desc'];
        $goodsModel->goods_typeid  = $attr['goods_typeid'];
        $goodsModel->is_refer      = $attr['is_refer'];
        $goodsModel->goods_img      = $attr['goods_img'];
        $goodsModel->create_time     = time();
        $goodsModel->save();
        $id = $goodsModel->id;
        if($id){
            flash('产品新增成功', 'success');
            return $id;
        }else{
            abort(500, '添加产品失败');
        }

    }

    /**
     * [updateGoods description]
     * @param  array  $attr [description]
     * @param  [type] $id   [description]
     * @return [type]       [description]
     */
     public function updateGoods(array $attr, $id)
    {

        $attr['update_time'] = time();
        $res = $this->update($attr, $id);


        if($res){
            $new_pic  = explode(",",$attr['goods_pictures']);
            $gallery = new Gallery();
            $res_pic    = $gallery->whereRaw('goods_id = '.$id)->get()->toArray();
            $old_pic    = array_column($res_pic, 'goods_pictures');
            $diff_array = array_diff($new_pic, $old_pic);
            $diff_array2 = array_diff($old_pic, $new_pic);
            if($diff_array){
                // 入库
               foreach($diff_array as $k => $v){
                   $isok= DB::table('cy_goods_gallery')->insert([
                       'goods_pictures'=>$v,
                       "goods_id" => $id,
                       "create_at" => time()
                   ]);
               }
            }
            if($diff_array2){
                foreach($diff_array2 as $k => $v){
                    $arr['status'] = 9;//软删除
                    $arr_single = $gallery->whereRaw('goods_id = '.$id.' and goods_pictures = '.$v)->first()->toArray();
                    $res        = $gallery->update($arr, ['id' => $arr_single['id']]);

                }
            }
                // 删除 status 9
            }
        if ($res) {
            flash('修改成功!', 'success');
        } else {
            flash('修改失败!', 'error');
        }
        return $res;
    }




}
