<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Http\Requests\MenuRequest;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\CommentRepositoryEloquent as CommentRepository;
use App\Repositories\Eloquent\PermissionRepositoryEloquent as PermissionRepository;
use App\Repositories\Eloquent\AdminUserRepositoryEloquent  as AdminUserRepository;
use App\Repositories\Eloquent\ClassesRepositoryEloquent as ClassesRepository;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Tests\DataCollector\DumpDataCollectorTest;

class CommentController extends Controller
{
    public $comment;
    public $permission;
    public $classes;

    public function __construct(
        CommentRepository    $commentRepository,
        PermissionRepository $permissionRepository,
        AdminUserRepository  $adminUserRepository,
        ClassesRepository    $classesRepository
    )
    {
        // $this->middleware('CheckPermission:Comment');
        $this->comment    = $commentRepository;
        $this->permission = $permissionRepository;
        $this->adminuser  = $adminUserRepository;
        $this->classes    = $classesRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    //评论模块
   public function pinglun(Request $request){
        $limit = (isset($request->all()['limit']))?$request->all()['limit']:3;
        $offset = (isset($request->all()['offset']))?$request->all()['offset']:1;

        $res  = $this->comment->recurse($request->all(), $limit , $offset);//$limit = 15,限制条数   $offset = 10 起始位置,
        $count = $res['count'];
        $res  = $res['data'];

        foreach ($res  as $k => $v){
            $v['create_at']                    =  toDate($v['create_at'] ,'-',true);
            $res[$k]['create_at']             =  $v['create_at'];
            //($v['user1_id'])    评论者的admin中的id
            $users        = $this->adminuser->getAdminUsers($v['user1_id']);
            if($users){
                $user1_name   = $users[0]->name; //admin中用户的名字
                $res[$k]['user1_id']  = $user1_name;
            }else{
                $res[$k]['user1_id']  = "匿名";

            }
            if(!empty($users['user1_id'])){
                $user2        = $this->adminuser->getAdminUsers($users['id']); //admin中用户的名字
                $user2_name   = $user2[0]->name;
                $res[$k]['user2_id']  = $user2_name;
            }else{
                $res[$k]['user2_id']  = "0";
            }
            //通过知道@者的 user2_id 获取  评论者的id
        }

        $return = [
            'status' => 200,
            'data'   => $res,
            'count'  => $count
         ];
        return response()->json($return,JSON_UNESCAPED_UNICODE);
    }





    //评论模块


    public function index()
    {
        // $data = $this->comment->limit(2)->orderBy('id', 'desc')->findWhere([])->toArray();
        //获取评论为多少

        //订单评论
        $module_id = $this->comment->getCommentList('module_id!=0');
//        dd($module_id);
//        $module_id = [
//            0 => [
//                'id' => 1,
//                'context' => '今天天气好好偶',
//            ],
//            1 => [
//                'id' => 2,
//                'context' => '今天晚上顿苦瓜排骨汤',
//            ],
//            2 => [
//                'id' => 3,
//                'context' => '周末宅家里',
//            ]
//        ];


        foreach($module_id as &$v1){
            $comment = $this->comment->recurse($v1['id'], 5 , 1);//$limit = 15,限制条数   $offset = 10 起始位置,
                        $v1['data'] = $comment['data'];
                foreach ( $v1['data']  as $k => $v){

                    $v['create_at']                    =  toDate($v['create_at'] ,'-',true);
                    $v1['data'][$k]['create_at']       =  $v['create_at'];
        //            ($v['user1_id'])    评论者的admin中的id
                    $users        = $this->adminuser->getAdminUsers($v['user1_id']);
                   if($users){
                       $user1_name   = $users[0]->name; //admin中用户的名字
                       $v1['data'][$k]['user1_id']  = $user1_name;
                   }else{
                       $v1['data'][$k]['user1_id']  = "匿名";

                   }
                    if(!empty($users['user1_id'])){
                        $user2        = $this->adminuser->getAdminUsers($users['id']); //admin中用户的名字
                        $user2_name   = $user2[0]->name;
                        $v1['data'][$k]['user2_id']  = $user2_name;
                    }else{
                        $v1['data'][$k]['user2_id']  = "0";
                    }
        //           通过知道@者的 user2_id 获取  评论者的id
                    }
        }
        return view('admin.comment.index', compact( 'module_id'));
    }



    public  function ajaxPage(){

//        $module_id = $_POST['module_id'];
//        $limit     = $_POST['ts'];
//        $offset    = $_POST['page'];
//
//        $res   = $this->comment->recurse($module_id, $limit, $offset);//$limit = 15,限制条数   $offset = 10 起始位置,
//
//             foreach ( $res  as $k => $v){
//                 $v['create_at']                    =  toDate($v['create_at'] ,'-',true);
//                 //($v['user1_id'])    评论者的admin中的id
//                 $users        = $this->adminuser->getAdminUsers($v['user1_id']);
//
//                 if($users){
//                     $user1_name   = $users[0]->name; //admin中用户的名字
//                     $res[$k]['user1_id']  = $user1_name;
//                 }else{
//                     $res[$k]['user1_id']  = "匿名";
//
//                 }
//                 if(!empty($users['user1_id'])){
//                     $user2        = $this->adminuser->getAdminUsers($users['id']); //admin中用户的名字
//                     $user2_name   = $user2[0]->name;
//                     $res[$k]['user2_id']  = $user2_name;
//                 }else{
//                     $res[$k]['user2_id']  = 0;
//                 }
//    //           通过知道@者的 user2_id 获取  评论者的id
//             }
//
//            return json_encode($res);

    }



    //递归转循环  已经被废弃
    public function toArray($data, $node = 'children', &$redata = []){
        foreach ($data as $v) {
            if($v[$node]){
                //只有自己出现的时候需要
                $redata[] = $v;
                $this->toArray($v[$node], $node, $redata);
            }else{
                $redata[] = $v;
            }
        }
        return $redata;
    }


        public function ajaxSweet(){
            $field = $field_val = '';
            $array = array('order','goods_id','bus_id','user_id');
            foreach ($array as $val){
                if(!empty($_POST[$val])){
                    if($val=='order'){
                        $field = 'module_id';
                    }else{
                        $field = $val;
                    }
                    $field_val = $_POST[$val];
                }
            }
            //二级以后评论
            if(isset($_POST['user2_id'])){
                $user2        = $this->adminuser->getNameAdmin($_POST['user2_id']); //admin中用户的名字
                foreach($user2 as $v){
                 $_POST['user2_id']  =  $v->id;
                }
            }else{
                $_POST['user2_id']  = '0';
                $_POST['id']        = "0";
            }
            //首次评论
            $user_id1=auth('admin')->user()->id;
            $submit_data = array(
                'pid'             => $_POST['id'],
                 $field       => $field_val,
                'user2_id'        => $_POST['user2_id'],
                'user1_id'        => $user_id1,
                'type'            => $_POST['type'],
                "content"         => $_POST['content'],
                "create_at"        => time(),
            );
            $bool = $this->comment->createComment($submit_data);
            if($bool){
                return ajaxReturn();
            }else{
                return ajaxErrorReturn();
            }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users   = $this->adminuser->getALlAdminUsers();
        //获取商户类型
        $classes = $this->classes->getList('class_type = 0');
        return view('admin.Comment.create',compact('users', 'classes'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->comment->createComment($request->all());
        return redirect('admin/comment');
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
        $Comment = $this->comment->editViewData($id);
        $users   = $this->adminuser->getALlAdminUsers();
        $classes = $this->classes->getList('class_type = 0');  //获取商户类型
        return view('admin.Comment.edit',compact('Comment', 'users', 'classes'));
    }

    /**
     * Update the specified resource in storage. 更新
     * @param MenuRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->comment->updateComment($request->all(),$id);
        return redirect('admin/Comment');
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
        $res = $this->comment->update($arr, $id);
        if ($res){
            flash('评论删除成功','success');
        }else{
            flash('评论删除失败','error');
        }
        return redirect('admin/comment');
    }

    /**
     * 接口获取信息
     */
    public function ajaxIndex(Request $request){
        $result = $this->comment->ajaxIndex($request);
        return response()->json($result,JSON_UNESCAPED_UNICODE);
    }

    /**
     * [addStaff description]
     * @param [type] $id [description]
     * @return  模板文件 [<description>]
     */
    public function commentInfo($id){
        //todo 添加员工
        $id = intval($id);
        if(!$id){
            abort('参数错误');
        }
        $Comment = $this->comment->find($id)->toArray();
        $Comment['tag_name'] = '';
        if($Comment['tag']){
            $arr_tag = explode(',', $Comment['tag']);
            foreach ($arr_tag as $value) {
                $middle_data = $this->classes->find($value)->toArray();
                if($Comment['tag_name']){
                    $Comment['tag_name'] .= ', '.$middle_data['name'];
                }else{
                    $Comment['tag_name'] .= $middle_data['name'];
                }
            }
        }
        //获取用户
        $user = $this->adminuser->find($Comment['user_id'])->toArray();
        $Comment['user_name']    =  ($user)?$user['name']:'';//获取用户名
        $Comment['create_time']  = toDate($Comment['create_time'], '-', true);
        $Comment['update_at']    = toDate($Comment['update_at'], '-', true);
        return view('admin.Comment.info', compact('id', 'Comment'));
    }
}
