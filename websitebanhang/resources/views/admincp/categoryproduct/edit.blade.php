
@extends('admincp.adminlayouts.admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
                <header class="panel-heading">
                    Cập nhật danh mục sản phẩm
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
                        <form action="{{route('categoryproduct.update',[$data->id])}}" method="POST">
                             @method('PUT') {{--phương thuc gia --}}
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên danh mục</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Tên danh  mục" name="category_name" value="{{$data->category_name}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả danh mục</label>
                                <textarea  style="resize:none" rows="5" class="form-control" id="exampleInputPassword1" placeholder="Mô ta danh mục" name="category_desc" >
                                    {{ $data->category_desc }}
                                </textarea>
                            </div>
                            <button type="submit" name="add_category_product" class="btn btn-info">Cập nhật</button>
                        </form>
                    </div>
                </div>
        </section>
    </div>
</div>
@endsection