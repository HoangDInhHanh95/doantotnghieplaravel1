@extends('admincp.adminlayouts.admin_layout')
@section('admin_content')
<h3>Chào mừng <?php
    $name = Session::get('admin_name');
    if($name){
        echo $name;
    }
    ?> đến với trang admin</h3>

@endsection