
@extends('admincp.adminlayouts.admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
                <header class="panel-heading">
                    Thêm sản phẩm
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
                        <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm" name="product_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá sản phẩm</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Giá sản phẩm" name="product_price">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Màu sắc sản phẩm</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Màu sắc sản phảm" name="product_color">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Size sản phẩm</label>
                                <select class="form-control input-sm m-bot15" name="product_size" >
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="S">L</option>
                                    <option value="M">XL</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                <input type="file" class="form-control" id="exampleInputEmail1"  name="product_image">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả sản phẩm  </label>
                                <textarea style="resize:none" rows="5" class="form-control" id="ckeditor2" placeholder="Mô ta sản phẩm" name="product_desc" >
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tóm tắt sản phẩm  </label>
                                <textarea style="resize:none" rows="5" class="form-control" id="ckeditor3" placeholder="Tóm tăt sản phẩm" name="product_content" >
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Danh  mục sản phẩm</label>
                                <select class="form-control input-sm m-bot15" name="category_id" >
                                    @foreach ($cate_product as $cate )
                                        <option value="{{$cate->id}}">{{$cate->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Thương hiệu sản phẩm</label>
                                <select class="form-control input-sm m-bot15" name="brand_id" >
                                    @foreach ($brand_products as $brand )
                                        <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                     @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hiển thị</label>
                                <select class="form-control input-sm m-bot15" name="product_status" >
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>
                                </select>
                            </div>
                            <button type="submit" name="add_brand_product" class="btn btn-info">Thêm mới</button>
                        </form>
                    </div>
                </div>
        </section>
    </div>
</div>
@endsection