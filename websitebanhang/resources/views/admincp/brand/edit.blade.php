
@extends('admincp.adminlayouts.admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
                <header class="panel-heading">
                    Cập nhật thương hiệu sản phẩm
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
                        <form action="{{route('brand.update',[$data->id])}}" method="POST">
                             @method('PUT') {{--phương thuc gia --}}
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên thương hiệu</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Tên danh  mục" name="brand_name" value="{{$data->brand_name}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                                <textarea  style="resize:none" rows="5" class="form-control" id="exampleInputPassword1" placeholder="Mô ta danh mục" name="brand_desc" >
                                    {{ $data->brand_desc }}
                                </textarea>
                            </div>
                            <button type="submit" name="add_brand_product" class="btn btn-info">Cập nhật</button>
                        </form>
                    </div>
                </div>
        </section>
    </div>
</div>
@endsection