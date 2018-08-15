<?php

namespace App\Repositories\Eloquent;

use DB;
use App\Models\Permission;
use App\Models\Ticket;
use App\Models\AdminUser;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\TicketRepository as TicketRepositoryInterface;

/**
 * Class MenuRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class TicketRepositoryEloquent extends BaseRepository implements TicketRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Ticket::class;
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
                $this->model = $this->model->whereRaw('(status <> 9 and (ticket_code like ? or ticket_name like ?))',[$keywords, $keywords]);
            }else{
                $this->model = $this->model->whereRaw('(status <> 9 and (ticket_code = ? or ticket_name = ?))',[$kyewordsValue, $kyewordsValue]);
            }
        }else{
            $this->model = $this->model->whereRaw('status <> 9');
        }

        $count = $this->model->count();
        $this->model = $this->model->orderBy($order['name'],$order['dir']);
        $this->model = $this->model->offset($start)->limit($length)->get();


        if ($this->model) {
            foreach ($this->model as $item) {

                $item->start_time = toDate( $item->start_time,'-',true);//有效期开始时间
                $item->end_time   = toDate( $item->end_time, '-' ,true);//有效期结束时间
                $item->create_at  = toDate( $item->create_at,'-',true);//创建时间
                $item->update_at  = toDate( $item->update_at, '-' ,true);//更新时间
                $username = DB::table('admins')->where('id',$item->user_id)->select(['name'])->first();
                $item->manage_name =  ($username)?$username->name:'';//优惠券名称
                $item->button = $item->getActionButtons('ticket', '', true);

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
        $ticket = $this->find($id, ['id','ticket_code','ticket_name','merchant_id','true_use_num','limit_num','create_at','update_at','start_time','end_time','condition','value','ticket_type','ticket_desc','goods_id','use_num','ticket_num']);
        if ($ticket) {
            return $ticket;
        }
        abort(404);
    }

    /**
     * 添加新商户
     */
    public function createTicket(array $attr)
    {

        $ticketModel                = new Ticket();
        $ticketModel->ticket_name   = $attr['ticket_name'];
        $ticketModel->ticket_desc   = $attr['ticket_desc'];
        $ticketModel->ticket_type   = $attr['ticket_type'];

        switch ( $ticketModel->ticket_type ){
            case 0  :$ticketModel->ticket_code=createTicketCode("J");  break;
            case 1  :$ticketModel->ticket_code=createTicketCode("Z");  break;
            case 2  :$ticketModel->ticket_code=createTicketCode("S"); break;

            default : break;
        }


        $ticketModel->value         = $attr['value'];
        $ticketModel->condition     = $attr['condition'];
        $ticketModel->goods_id      = $attr['goods_id'];
        $ticketModel->use_num       = $attr['use_num'];
        $ticketModel->ticket_num    = $attr['ticket_num'];
        $ticketModel->merchant_id   = $attr['merchant_id'];
        $ticketModel->true_use_num  = $attr['true_use_num'];
        $ticketModel->limit_num     = $attr['limit_num'];
        $ticketModel->start_time    =  strtotime($attr['start_time']);
        $ticketModel->end_time      =  strtotime($attr['end_time']);
        $ticketModel->create_at   = time();

        $ticketModel->save();

        flash('优惠券新增成功', 'success');
    }

    /**
     * [updateBusinesses description]
     * @param  array  $attr [description]
     * @param  [type] $id   [description]
     * @return [type]       [description]
     */
     public function updateTicket(array $attr, $id)
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



    public function ticketType(){
        $arr_ticket_type=[
            0=>"满减",
            1=>"满折",
            2=>"满送",
        ];
        return $arr_ticket_type;
    }
    public function arrValue(){
        $arr_value=[
            0=>"50元",
            1=>"8折",
            2=>"送大礼包",
        ];
        return $arr_value;
    }
    public function arrCondition(){
        $arr_condition=[
            0=>"不限",
            1=>"满100以上",
            2=>"满200以上",
        ];
        return $arr_condition;
    }
    public function goodsId(){
        $arr_goods_id=[
            0=>"全店",
            1=>"会员",
        ];
        return $arr_goods_id;
    }
    public function merchantId(){
        $arr_merchant_id=[
            0=>"商家发放",
            1=>"后台发放",
        ];
        return $arr_merchant_id;
    }
    public function ticketNum(){
        $arr_ticket_num=[
            0=>"不限",
            1=>"100张",
            2=>"200张",
        ];
        return $arr_ticket_num;
    }
    public function limitNum(){
        $arr_limit_num=[
            0=>"限制",
            1=>"不限制",
        ];
        return $arr_limit_num;
    }








}
