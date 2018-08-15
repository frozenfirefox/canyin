<?php

namespace App\Repositories\Eloquent;

use DB;
use App\Models\Permission;
use App\Models\File;
use App\Models\AdminUser;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\FileRepository as FileRepositoryInterface;

/**
 * Class MenuRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class FileRepositoryEloquent extends BaseRepository implements FileRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return File::class;
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
        $dash            = $request->input('is_dash', 0);
        $length          = $request->input('length', 10);
        $order['name']   = $request->input('columns.' .$request->input('order.0.column') . '.name');
        $order['dir']    = $request->input('order.0.dir', 'asc');
        $search['value'] = $request->input('search.value', '');
        $search['regex'] = $request->input('search.regex', false);

        $con_status = ($dash)?'status = 9':'status <> 9';

        if ($search['value']){
            $keywords = "%{$search['value']}%";
            $kyewordsValue = "{$search['value']}";
            if ($search['regex'] == 'true'){
                $this->model = $this->model->whereRaw('('.$con_status.' and (name like ? or savename like ?))',[$keywords, $keywords]);
            }else{
                $this->model = $this->model->whereRaw('('.$con_status.' and (name = ? or savename = ?))',[$kyewordsValue, $kyewordsValue]);
            }
        }else{
            $this->model = $this->model->whereRaw($con_status);
        }

        $count = $this->model->count();
        $this->model = $this->model->orderBy($order['name'],$order['dir']);
        $this->model = $this->model->offset($start)->limit($length)->get();

        if ($this->model) {
            foreach ($this->model as $item) {
                $item->create_time  = ($item->create_time)?date('Y-m-d H:i:s',$item->create_time):'';//创建时间
                $item->update_at    = ($item->update_at)?date('Y-m-d H:i:s',$item->update_at):'';//更新时间
                $username = DB::table('admins')->where('id',$item->user_id)->select(['name'])->first();
                $item->manage_name  =  ($username)?$username->name:'';//消息标题
                $item->dash         = $dash;//是否为回收站 删除
                if($dash){
                    $item->button   = $item->getActionButtons('filedash');
                }else{
                    $item->button   = $item->getActionButtons('file', '', true);
                }

                $arr_location = [
                    0 => '本地',
                    1 => '其它'
                ];
                $item->location = $arr_location[$item->location];

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

    $file = $this->find($id, ['*']);
    if ($file) {
        return $file;
    }
    abort(404);
}
    /**
     * 添加新商户
     */
    public function createFile(array $attr)
    {
        $fileModel                =  new File();
        $fileModel->name          = $attr['name'];
        $fileModel->size          = $attr['size'];
        $fileModel->ext           = $attr['ext'];
        $fileModel->md5           = $attr['md5'];
        $fileModel->sha1          = $attr['sha1'];
        $fileModel->mime          = $attr['mime'];
        $fileModel->savename      = $attr['savename'];
        $fileModel->savepath      = $attr['savepath'];
        $fileModel->location      = $attr['location'];
        $fileModel->path          = $attr['path'];
        $fileModel->abs_url       = $attr['abs_url'];
        $fileModel->oss_path      = $attr['oss_path'];
        $fileModel->create_time   = time();
        $fileModel->save();
        flash('消息新增成功', 'success');

        return $fileModel->id;
    }

    /**
     * [updateBusinesses description]
     * @param  array  $attr [description]
     * @param  [type] $id   [description]
     * @return [type]       [description]
     */
     public function updateFile(array $attr, $id)
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
