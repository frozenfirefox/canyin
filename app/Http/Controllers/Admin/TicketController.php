<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\BusinessesRepositoryEloquent as BusinessesRepository;
use App\Repositories\Eloquent\TicketRepositoryEloquent as TicketRepository;
use App\Repositories\Eloquent\PermissionRepositoryEloquent as PermissionRepository;
use App\Repositories\Eloquent\AdminUserRepositoryEloquent  as AdminUserRepository;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    public $ticket;
    public $permission;
    public $businesses;

    public function __construct(
        TicketRepository $ticketRepository,
        PermissionRepository $permissionRepository,
        AdminUserRepository $adminUserRepository,
        BusinessesRepository $businessesRepository
    )
    {
        // $this->middleware('CheckPermission:businesses');
        $this->ticket     = $ticketRepository;
        $this->permission = $permissionRepository;
        $this->adminuser  = $adminUserRepository;
        $this->businesses = $businessesRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $field = ['id','name','turnover','phone','address','user_id','create_time','updated_at'];
        // $businesses = $this->businesses->getAll($field);
//        $field = ['*'];
//        $ticket = $this->ticket->getAll($field);
        return view('admin.ticket.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $arr_ticket_type  =    $this->ticket->ticketType();
        $arr_value        =    $this->ticket->arrValue();
        $arr_condition    =    $this->ticket->arrCondition();
        $arr_goods_id     =    $this->ticket->goodsId();
        $arr_merchant_id  =    $this->ticket->merchantId();
        $arr_ticket_num   =    $this->ticket->ticketNum();
        $arr_limit_num    =    $this->ticket->limitNum();
        return view('admin.ticket.create',compact('arr_ticket_type','arr_value','arr_condition','arr_goods_id','arr_merchant_id','arr_ticket_num','arr_limit_num'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->ticket->createTicket($request->all());
        return redirect('admin/ticket');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * 编辑页面
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $arr_ticket_type  =    $this->ticket->ticketType();
        $arr_value        =    $this->ticket->arrValue();
        $arr_condition    =    $this->ticket->arrCondition();
        $arr_goods_id     =    $this->ticket->goodsId();
        $arr_merchant_id  =    $this->ticket->merchantId();
        $arr_ticket_num   =    $this->ticket->ticketNum();
        $arr_limit_num    =    $this->ticket->limitNum();

        $ticket = $this->ticket->editViewData($id);
        return view('admin.ticket.edit',compact('ticket','arr_ticket_type','arr_value','arr_condition','arr_goods_id','arr_merchant_id','arr_ticket_num','arr_limit_num'));
    }

    /**
     * Update the specified resource in storage. 更新
     * @param MenuRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->ticket->updateTicket($request->all(),$id);
        return redirect('admin/ticket');
    }

    /**
     * Remove the specified resource from storage.
     * 删除
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $arr['status'] = 9;//软删除
        $res = $this->ticket->update($arr, $id);
        if ($res){

            flash('优惠劵删除成功','success');
        }else{
            flash('优惠劵除失败','error');
        }
        return redirect('admin/ticket');
    }

    /**
     * 接口获取信息
     */
    public function ajaxIndex(Request $request){
        $result = $this->ticket->ajaxIndex($request);
        return response()->json($result,JSON_UNESCAPED_UNICODE);
    }

    /**
     * [addStaff description]
     * @param [type] $id [description]
     * @return  模板文件 [<description>]
     */
    public function ticketInfo($id){

        $id = intval($id);
        if(!$id){
            abort('参数错误');
        }
        $ticket = $this->ticket->find($id)->toArray();

        $arr_ticket_type        =    $this->ticket->ticketType();
        $arr_value              =    $this->ticket->arrValue();
        $arr_condition          =    $this->ticket->arrCondition();
        $arr_goods_id           =    $this->ticket->goodsId();
        $arr_merchant_id        =    $this->ticket->merchantId();
        $arr_ticket_num         =    $this->ticket->ticketNum();
        $arr_limit_num          =    $this->ticket->limitNum();

        if($ticket['merchant_id'] > 0){
            //获取商户id
            $businesses             =   $this->businesses->findByField('id', $ticket['merchant_id'], ['name'])->toArray();
            if($businesses){
                $ticket['merchant_id']  =   $businesses[0]['name'];
            }else{
                $ticket['merchant_id']  =   '外星商户';
            }
        }else{
            $ticket['merchant_id']  =   $arr_merchant_id[$ticket['merchant_id']];
        }
        $ticket['ticket_type']  =   $arr_ticket_type[$ticket['ticket_type']];
        $ticket['value']        =   $arr_value[$ticket['value']];
        $ticket['condition']    =   $arr_condition[$ticket['condition']];
        $ticket['goods_id']     =   $arr_goods_id[$ticket['goods_id']];
        $ticket['ticket_num']   =   $arr_ticket_num[$ticket['ticket_num']];
        $ticket['limit_num']    =   $arr_limit_num[$ticket['limit_num']];
        $ticket['start_time']   =   toDate($ticket['start_time'], '-', true);
        $ticket['end_time']     =   toDate($ticket['end_time'], '-', true);
        $ticket['create_at']    =   toDate($ticket['create_at'], '-', true);
        $ticket['update_at']    =   toDate($ticket['update_at'], '-', true);
        return view('admin.ticket.info', compact('id', 'ticket'));
    }
}
