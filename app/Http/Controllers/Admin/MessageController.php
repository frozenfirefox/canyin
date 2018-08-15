<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\MessageRepositoryEloquent as MessageRepository;
use App\Repositories\Eloquent\PermissionRepositoryEloquent as PermissionRepository;
use App\Repositories\Eloquent\AdminUserRepositoryEloquent  as AdminUserRepository;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public $message;
    public $permission;

    public function __construct(MessageRepository $messageRepository,PermissionRepository $permissionRepository,AdminUserRepository $adminUserRepository)
    {
        // $this->middleware('CheckPermission:businesses');
        $this->message    = $messageRepository;
        $this->permission = $permissionRepository;
        $this->adminuser  = $adminUserRepository;
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
        return view('admin.message.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr_status    = $this->message->arrStatus();
        $arr_msg_type  = $this->message->arrMsgType();
        $arr_user      = $this->message->arrUser();
        return view('admin.message.create',compact('arr_status','arr_msg_type','arr_user'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->message->createMessage($request->all());
        return redirect('admin/message');
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
        $arr_status    = $this->message->arrStatus();
        $arr_msg_type  = $this->message->arrMsgType();
        $arr_user      = $this->message->arrUser();
        $message       = $this->message->editViewData($id);
        return view('admin.message.edit',compact('message','arr_status','arr_msg_type','arr_user'));
    }

    /**
     * Update the specified resource in storage. 更新
     * @param MenuRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->message->updateMessage($request->all(),$id);
        return redirect('admin/message');
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
        $res = $this->message->update($arr, $id);
        if ($res){
            flash('消息删除成功','success');
        }else{
            flash('消息删除失败','error');
        }
        return redirect('admin/message');
    }

    /**
     * 接口获取信息
     */
    public function ajaxIndex(Request $request){
        $result = $this->message->ajaxIndex($request);
        return response()->json($result,JSON_UNESCAPED_UNICODE);
    }
    public function messageInfo($id){
        $id = intval($id);
        if(!$id){
            abort('参数错误');
        }

        $message = $this->message->find($id)->toArray();
        //调用自定义数组
        $arr_status           = $this->message->arrStatus();
        $arr_msg_type         = $this->message->arrMsgType();
        $arr_user             = $this->message->arrUser();
        $message['msg_type']  = $arr_msg_type[$message['msg_type']];
        $message['status']    = $arr_status[$message['status']];
        $message['user_id']   = $arr_user[$message['user_id']];
        return view('admin.message.info', compact('id', 'message'));
    }

}
