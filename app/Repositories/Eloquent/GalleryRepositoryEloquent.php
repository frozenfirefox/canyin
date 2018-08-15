<?php

namespace App\Repositories\Eloquent;

use App\Models\Gallery;
use DB;
use App\Models\Permission;
use App\Models\AdminUser;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\GalleryRepository as GalleryRepositoryInterface;

/**
 * Class MenuRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class GalleryRepositoryEloquent extends BaseRepository implements GalleryRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Gallery::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */

    public function editViewData($id)
    {
        $gallery = $this->find($id, ['goods_id','goods_pictures','sort','create_at','update_at']);
        if ($gallery) {
            return $gallery;
        }
        abort(404);
    }


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
                $this->model = $this->model->whereRaw('(status <> 9 and (goods_id like ? or goods_pictures like ?))',[$keywords, $keywords]);
            }else{
                $this->model = $this->model->whereRaw('(status <> 9 and (goods_id = ? or goods_pictures = ?))',[$kyewordsValue, $kyewordsValue]);
            }
        }else{
            $this->model = $this->model->whereRaw('status <> 9');
        }

        $count = $this->model->count();
        $this->model = $this->model->orderBy($order['name'],$order['dir']);
        $this->model = $this->model->offset($start)->limit($length)->get();
        if ($this->model) {
            foreach ($this->model as $item) {
                $item->create_at  = toDate( $item->create_at,'-',true);//创建时间
                $item->update_at  = toDate( $item->update_at, '-' ,true);//更新时间
                $username = DB::table('admins')->where('id',$item->user_id)->select(['name'])->first();
                $item->manage_name =  ($username)?$username->name:'';//图片集名称
                $item->button = $item->getActionButtons('gallery', '', true);

            }
        }

        return [
            'draw'              =>$draw,
            'recordsTotal'      =>$count,
            'recordsFiltered'   =>$count,
            'data'              =>$this->model
        ];
    }

//    public function editViewData($id)
//    {
//        $gallery = $this->find($id, ['id','goods_id','goods_pictures','sort','create_at','update_at']);
//        if ($gallery) {
//            return $gallery;
//        }
//        abort(404);
//    }
//
//    public function picViewData($goods_id)
//    {
//        $gallery=DB::table("cy_goods_gallery")->where('goods_id','=',$goods_id)->get(); //一个条件
//        if ($gallery) {
//            return $gallery;
//        }
//        abort(404);
//    }




    /**
     * 添加新图片
     */
    public function createGallery(array $attr)
    {

        $galleryModel                   = new Gallery();
        $galleryModel->goods_id         = $attr['goods_id'];
        $galleryModel->goods_pictures   = $attr['goods_pictures'];
        $galleryModel->sort             = $attr['sort'];
        $galleryModel->create_at        = time();
        $galleryModel->save();

        flash('图片新增成功', 'success');
    }

    /**
     * [updateBusinesses description]
     * @param  array  $attr [description]
     * @param  [type] $id   [description]
     * @return [type]       [description]
     */
     public function updateGallery(array $attr, $id)
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
