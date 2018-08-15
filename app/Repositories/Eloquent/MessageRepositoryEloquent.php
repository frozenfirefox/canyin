<?php

namespace App\Repositories\Eloquent;

use DB;
use App\Models\Permission;
use App\Models\Message;
use App\Models\AdminUser;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\MessageRepository as MessageRepositoryInterface;

/**
 * Class MenuRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class MessageRepositoryEloquent extends BaseRepository implements MessageRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Message::class;
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
                $this->model = $this->model->whereRaw('(status <> 9 and (title like ? or context like ?))',[$keywords, $keywords]);
            }else{
                $this->model = $this->model->whereRaw('(status <> 9 and (title = ? or context = ?))',[$kyewordsValue, $kyewordsValue]);
            }
        }else{
            $this->model = $this->model->whereRaw('status <> 9');
        }

        $count = $this->model->count();
        $this->model = $this->model->orderBy($order['name'],$order['dir']);
        $this->model = $this->model->offset($start)->limit($length)->get();

        if ($this->model) {
            foreach ($this->model as $item) {
                $item->create_at = ($item->create_at)?date('Y-m-d H:i:s',$item->create_at):'';//创建时间
                $item->update_at = ($item->update_at)?date('Y-m-d H:i:s',$item->update_at):'';//更新时间
                $username = DB::table('admins')->where('id',$item->user_id)->select(['name'])->first();
                $item->manage_name =  ($username)?$username->name:'';//消息标题
                $item->button = $item->getActionButtons('message', '', true);
                $arr_msg_type = [
                    0 => '系统消息',
                    1 => '订单消息'
                ];
                $item->msg_type = $arr_msg_type[ $item->msg_type];
                $arr_status = [
                    0 => '正常',
                    1 => '其他'
                ];
                $item->status   = $arr_status[ $item->status];
                $arr_user = [
                    0 => '全部用户',
                    1 => '个人用户'
                ];
                $item->user_id  = $arr_user[ $item->user_id];


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
        $message = $this->find($id, ['id','title','context','msg_type','status','user_id','create_at','update_at']);
        if ($message) {
            return $message;
        }
        abort(404);
    }


    /**
     * 添加新商户
     */
    public function createMessage(array $attr)
    {
        $messageModel                =  new Message();
        $messageModel->title        = $attr['title'];
        $messageModel->context      = $attr['context'];
        $messageModel->status       = $attr['status'];
        $messageModel->msg_type       = $attr['msg_type'];
        $messageModel->user_id       = $attr['user_id'];
        $messageModel->create_at   = time();
        $messageModel->save();
        flash('消息新增成功', 'success');
    }

    /**
     * [updateBusinesses description]
     * @param  array  $attr [description]
     * @param  [type] $id   [description]
     * @return [type]       [description]
     */
     public function updateMessage(array $attr, $id)
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

    /**
     * 自定义数组  使用在下拉选项
     */
    public function arrUser(){
        $arr_user = [
            0 => '全部用户',
            1 => '个人用户'
        ];
        return $arr_user;
   }

    public function arrStatus(){
        $arr_status = [
            0 => '正常',
            1 => '其他'
        ];
        return $arr_status;
    }

    public function arrMsgType(){
        $arr_msg_type = [
            0 => '系统消息',
            1 => '订单消息'
        ];
        return $arr_msg_type;
    }


}
