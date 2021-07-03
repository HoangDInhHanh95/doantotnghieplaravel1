@extends('admincp.adminlayouts.admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
                <header class="panel-heading">
                    Thêm slider banner
                </header>
                <div class="panel-body">
                    <div class="position-center">
                     {{-- status thông báo lỗi --}}
                     @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif 
                     {{--end status thông báo lỗi slider_banner_image --}}
                        <form action="{{ route('slider.store')}}" method="POST" enctype="multipart/form-data"> 
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tiêu đề slider</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Tên danh  mục" name="slider_title">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh slider banner</label>
                                <input type="file" class="form-control" id="exampleInputEmail1"  name="slider_image">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả slider banner</label>
                                <textarea style="resize:none" rows="5" class="form-control"  placeholder="Mô tả slider banner" name="slider_desc" >
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Trạng thái</label>
                                <select class="form-control input-sm m-bot15" name="slider_status" >
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>
                                </select>
                            </div>
                            <button type="submit" name="add_slider_banner" class="btn btn-info">Thêm mới</button>
                        </form>
                    </div>
                </div>
        </section>
    </div>
</div>
@endsection