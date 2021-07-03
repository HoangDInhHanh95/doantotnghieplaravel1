@extends('admincp.adminlayouts.admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
                <header class="panel-heading">
                    Thêm danh mục tin tức
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
                        <form action="{{route('categorynew.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Danh mục tin tức</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Tên danh  mục" name="cate_news_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Trạng thái</label>
                                <select class="form-control input-sm m-bot15" name="cate_news_status" >
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>
                                </select>
                            </div>
                            <button type="submit" name="add_cate_new" class="btn btn-info">Thêm mới</button>
                        </form>
                    </div>
                </div>
        </section>
    </div>
</div>
@endsection