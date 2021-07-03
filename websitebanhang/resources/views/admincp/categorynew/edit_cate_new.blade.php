
@extends('admincp.adminlayouts.admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
                <header class="panel-heading">
                    Cập nhật danh mục tin tức
                </header>
                <div class="panel-body">
                    <div class="position-center">
                     {{-- status thông báo lỗi --}}
                     @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif 
                     {{--end status thông báo lỗi --}}
                        <form action="{{route('categorynew.update',[$data->cate_news_id])}}" method="POST">
                             @method('PUT') {{--phương thuc gia --}}
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên danh mục</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Tên danh  mục" name="cate_news_name" value="{{$data->cate_news_name}}">
                            </div>
                            
                            <button type="submit" name="update_cate_new" class="btn btn-info">Cập nhật</button>
                        </form>
                    </div>
                </div>
        </section>
    </div>
</div>
@endsection