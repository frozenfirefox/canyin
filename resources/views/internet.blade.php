@extends('layouts.frontend.master')

@section('body')
<style>
    .dis ul,.dis ul li{
        list-style: none;
    }
    .dis ul li{
        width: 12%;
        display: inline-block;
        overflow: hidden;
        margin-left: 1%;
    }
</style>
    <div class="dis">
        <ul>
            <li>id</li>
            <li>姓名</li>
            <li>邮箱</li>
            <li>密码</li>
            <li>remember_token</li>
            <li>创建时间</li>
            <li>更新时间</li>
        </ul>
    </div>

@foreach ($users as $user)
    <div class="dis">
        <ul>
            <li>{{ $user->id }}</li>
            <li>{{ $user->name }}</li>
            <li>{{ $user->email }}</li>
            <li>{{ $user->password }}</li>
            <li>{{ $user->remember_token }}</li>
            <li>{{ $user->created_at }}</li>
            <li>{{ $user->updated_at }}</li>
        </ul>
    </div>
@endforeach

@endsection

@section('title')

{{ $title }}

@endsection