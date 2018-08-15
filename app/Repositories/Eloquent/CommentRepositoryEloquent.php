<?php

namespace App\Repositories\Eloquent;

use App\Models\Comment;
use DB;
use App\Models\Permission;
use App\Models\AdminUser;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\CommentRepository as CommentRepositoryInterface;

/**
 * Class CommentRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class CommentRepositoryEloquent extends BaseRepository implements CommentRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Comment::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * 获取评论全部内容
     */
    public function getAllData(){
        $result = $this->model->whereRaw('status <> 9')->get()->toArray();
        return $result;
    }



    //递归查询 无限级查询 控制一级查询数目 最后做异步加载
    public function recurse($postDatas, $limit = 15, $offset = 10, $id = 0, $level = 0, &$redata = [], &$count = 0){
        $field = '';
        $array = array('order','goods_id','bus_id','user_id');
        foreach ($array as $val){
            if(!empty($postDatas[$val])){
                if($val=='order'){
                    $field = 'module_id';
                }else{
                    $field = $val;
                }
                $field_val = $postDatas[$val];
            }
        }

        $where[] = ['status', '<>', 9];
        $where[] = [$field, '=', $field_val];
        $where[] = ['pid', '=', $id];
        if($id == 0){
            $middle = $this->model->offset($offset)->limit($limit)->orderBy('id', 'asc')->where($where)->get()->toArray();
            $count  = $this->model->where($where)->count();
        }else{
            $middle = $this->model->orderBy('id', 'asc')->where($where)->get()->toArray();
        }
        $level++;

        if($middle){
            foreach ($middle as $x) {
                $x['pre']   = '└'.str_repeat('──', $level);
                $redata[]   = $x;
                $this->recurse($postDatas, $limit, $offset, $x['id'], $level, $redata);
            }
        }

        return ['data' => $redata, 'count' => $count];
    }


    public function getList($condition){
        return $this->model->whereRaw('status <> 9 and '.$condition)->get()->toArray();

    }

    public function getCommentList($condition){
        return $this->model->leftJoin('cy_order','cy_order.id','=','cy_comment.module_id')->whereRaw('status <> 9 and '.$condition)->groupBy('module_id')->get()->toArray();
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
                $item->button = $item->getActionButtons('Comment', '', true);

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
//        $Comment = $this->find($id, ['id','goods_id','goods_pictures','sort','create_at','update_at']);
//        if ($Comment) {
//            return $Comment;
//        }
//        abort(404);
//    }
//
//    public function picViewData($goods_id)
//    {
//        $Comment=DB::table("cy_goods_Comment")->where('goods_id','=',$goods_id)->get(); //一个条件
//        if ($Comment) {
//            return $Comment;
//        }
//        abort(404);
//    }




    /**
     * 添加评论
     */
    public function createComment(array $attr)
    {
        $CommentModel                   = new Comment();
        if(isset($attr['module_id'])){
            $CommentModel->module_id        = $attr['module_id'];
        }elseif(isset($attr['bus_id'])){
            $CommentModel->bus_id        = $attr['bus_id'];
        }elseif(isset($attr['users_id'])){
            $CommentModel->users_id        = $attr['users_id'];
        }elseif(isset($attr['goods_id'])) {
            $CommentModel->goods_id = $attr['goods_id'];
        }

        $CommentModel->user1_id         = $attr['user1_id'];
        $CommentModel->user2_id         = $attr['user2_id'];
        $CommentModel->pid              = $attr['pid'];
        $CommentModel->content          = $attr['content'];
        $CommentModel->type             = $attr['type'];
//        $CommentModel->index            = $attr['index'];
        $CommentModel->create_at        = time();
        return $CommentModel->save();
//        flash('评论新增成功', 'success');
    }

    /**
     * [updateBusinesses description]
     * @param  array  $attr [description]
     * @param  [type] $id   [description]
     * @return [type]       [description]
     */
     public function updateComment(array $attr, $id)
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
