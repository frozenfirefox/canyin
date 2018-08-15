@extends('layouts.frontend.master')

@section('body')

<h1>沃天科技</h1>
<div id="change">
    <p>名称 ：${ name }</p>
    <p>年收入 ：${ item }</p>
    <p>地址 ：${ address }</p>
    <p>电话 ：${ phone }</p>
</div>
@endsection

@section('title')

{{ $title }}

@endsection

@section('sitename')

{{ $sitename }}

@endsection

@section('js_my')

<script src="{{ asset('asset_admin/js/output.js') }}"></script>

@endsection