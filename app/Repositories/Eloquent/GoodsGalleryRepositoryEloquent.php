<?php

namespace App\Repositories\Eloquent;

use DB;
use App\Models\Permission;
use App\Models\GoodsGallery;
use App\Models\AdminUser;
use App\Models\Classes;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\GoodsGalleryRepository as GoodsGalleryRepositoryInterface;

/**
 * Class MenuRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class GoodsGalleryRepositoryEloquent extends BaseRepository implements GoodsGalleryRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return GoodsGallery::class;
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
        $start           = $request->input('start',0);
        $length          = $request->input('length',10);
        $order['name']   = $request->input('columns.' .$request->input('order.0.column') . '.name');
        $order['dir']    = $request->input('order.0.dir','asc');
        $search['value'] = $request->input('search.value','');
        $search['regex'] = $request->input('search.regex',false);

        if ($search['value']){
            $keywords = "%{$search['value']}%";
            $kyewordsValue = "{$search['value']}";
            $namelike = "%{$search['value']}%";
            $nameValue = "{$search['value']}";
            if ($search['regex'] == 'true'){
                $this->model = $this->model->whereRaw('(status <> 9 and merchant_id = ? and (goodsGallery_name like ? or keyword like ?))',[$bid, $namelike, $keywords]);
            }else{
                $this->model = $this->model->whereRaw('(status <> 9 and merchant_id = ? and (goodsGallery_name = ? or keyword = ?))',[$bid, $nameValue, $kyewordsValue]);
            }
        }else{
            $this->model = $this->model->whereRaw('status <> 9 and merchant_id = '.$bid);
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
                $classesName        = DB::table('cy_classes')->where('id',$item->goodsGallery_typeid)->select(['name'])->first();
                $item->type_name    = ($classesName)?$classesName->name:'';//获取产品类别
                $item->is_refer     = ($item->is_refer == 1)?'是':'否';

                $item->button       = $item->getActionButtons('goodsGallery', '', true);
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
    public function createGoodsGallery(array $Gallery)
    {
        $goodsGalleryModel                = new GoodsGallery();
        $goodsGalleryModel->keyword       = $Gallery['keyword'];
        $goodsGalleryModel->goodsGallery_name    = $Gallery['goodsGallery_name'];
        $goodsGalleryModel->merchant_id   = $Gallery['businesses_id'];
        $goodsGalleryModel->goodsGallery_brief   = $Gallery['goodsGallery_brief'];
        $goodsGalleryModel->goodsGallery_desc    = $Gallery['goodsGallery_desc'];
        $goodsGalleryModel->goodsGallery_typeid  = $Gallery['goodsGallery_typeid'];
        $goodsGalleryModel->is_refer      = $Gallery['is_refer'];
        $goodsGalleryModel->create_time     = time();

        $goodsGalleryModel->save();
        flash('产品新增成功', 'success');
    }

    /**
     * [updateGoodsGallery description]
     * @param  array  $Gallery [description]
     * @param  [type] $id   [description]
     * @return [type]       [description]
     */
     public function updateGoodsGallery(array $Gallery, $id)
    {
        $Gallery['update_time'] = time();
        $res = $this->update($Gallery, $id);

        if ($res) {
            flash('修改成功!', 'success');
        } else {
            flash('修改失败!', 'error');
        }
        return $res;
    }
}
