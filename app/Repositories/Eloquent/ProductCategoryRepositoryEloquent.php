<?php

namespace App\Repositories\Eloquent;

use DB;
use App\Models\Permission;
use App\Models\ProductCategory;
use App\Models\AdminUser;
use App\Models\Classes;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\ProductCategoryRepository as ProductCategoryRepositoryInterface;

/**
 * Class MenuRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class ProductCategoryRepositoryEloquent extends BaseRepository implements ProductCategoryRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProductCategory::class;
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
//        $bid             = $request->input('bid', 0);
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
//                $this->model = $this->model->whereRaw('(status <> 9 and id = ? and (name like ? or short_name like ?))',[$bid, $namelike, $keywords]);
                $this->model = $this->model->whereRaw('(status <> 9 and (name like ? or short_name like ?) and type=1)',[$namelike, $keywords]);
            }else{
//                $this->model = $this->model->whereRaw('(status <> 9 and id = ? and (name = ? or short_name = ?))',[$bid, $nameValue, $kyewordsValue]);
                $this->model = $this->model->whereRaw('(status <> 9 and (name = ? or short_name = ?) and type=1)',[$nameValue, $kyewordsValue]);
            }
        }else{
//            $this->model = $this->model->whereRaw('status <> 9 and id = '.$bid);
            $this->model = $this->model->whereRaw('status <> 9 and type=1');
        }

        $count = $this->model->count();
        $this->model = $this->model->orderBy($order['name'],$order['dir']);
        $this->model = $this->model->offset($start)->limit($length)->get();

        if ($this->model) {
            foreach ($this->model as $item) {
                $item->create_at  = toDate($item->create_at, '-', true);//创建时间
                $item->update_at  = toDate($item->update_at, '-', true);//更新时间
                $item->button       = $item->getActionButtons('productcategory', '', true);
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
     * 添加新商品分类
     */
    public function createGoodsCategory(array $Category)
    {
        $goodsCategoryModel                 = new ProductCategory();
        $goodsCategoryModel->goods_id       = $Category['goods_id'];
        $goodsCategoryModel->name           = $Category['name'];
        $goodsCategoryModel->short_name     = $Category['short_name'];
        $goodsCategoryModel->cate_img       = $Category['cate_img'];
        $goodsCategoryModel->parent_id      = $Category['parent_id'];
        $goodsCategoryModel->min_rate       = $Category['min_rate'];
        $goodsCategoryModel->sort           = $Category['sort'];
        $goodsCategoryModel->type           = 1;
        $goodsCategoryModel->create_at      = time();


        $goodsCategoryModel->save();
        flash('商品分类新增成功', 'success');
    }

    /**
     * [updateGoodsCategory description]
     * @param  array  $Category [description]
     * @param  [type] $id   [description]
     * @return [type]       [description]
     */
     public function updateGoodsCategory(array $Category, $id)
    {
        $Category['update_at'] = time();
        $res = $this->update($Category, $id);

        if ($res) {
            flash('修改成功!', 'success');
        } else {
            flash('修改失败!', 'error');
        }
        return $res;
    }
}
