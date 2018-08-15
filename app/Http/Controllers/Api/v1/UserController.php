<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use App\Repositories\Eloquent\AdminUserRepositoryEloquent as AdminUserRepository;

class UserController extends Controller
{
    public $adminUser;

    public function __construct(AdminUserRepository $adminUserRepository)
    {
        // $this->middleware('CheckPermission:adminuser');
        $this->adminUser = $adminUserRepository;
        // $this->role = $roleRepository;
    }

    public function show(Request $request)
    {
        dd(JWTAuth::parseToken());
        if($request->token){
            $token = JWTAuth::toUser($request->token);
            dd($token);
        }else{
            $user = new \stdClass();
            $user->id = 1;
            $token = JWTAuth::fromUser($user);
        }

        return $this->response->array(['token' => $token]);
    }
}
