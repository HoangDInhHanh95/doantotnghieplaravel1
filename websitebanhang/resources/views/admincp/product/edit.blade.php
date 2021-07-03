
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
                     @foreach($edit_product as $product)
                        <form action="{{route('product.update',[$product->product_id])}}" method="POST" enctype="multipart/form-data">
                            @method('PUT') {{--phương thuc gia --}}
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" 
                                value="{{ $product->product_name }}" name="product_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá sản phẩm</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" value="{{ $product->product_price }}"  name="product_price">
                            </div>
                            {{-- cai đạt cho chon size --}}
                            <div class="form-group">
                                <label for="exampleInputPassword1">Size sản phẩm</label>
                                <select  class="form-control input-sm m-bot15" name="product_size" >
                                    @if ($product->product_size == "S")
                                         <option selected value="S">S</option>
                                         <option value="M">M</option>
                                         <option value="L">L</option>
                                         <option value="XL">XL</option>
                                    @elseif($product->product_size == 'M')
                                        <option selected value="M">M</option>
                                        <option value="S">S</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                    @elseif ($product->product_size == 'L')
                                        <option selected  value="L">L</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="XL">XL</option>
                                    @elseif ($product->product_size == 'XL')
                                        <option selected value="XL">XL</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>                                
                                    @endif
                                        
                                </select>
                            </div>
                            {{-- /cai đạt cho chon size --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Màu sắc sản phẩm</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" value="{{ $product->product_color }}" name="product_color">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                <br/>
                                <img src="{{URL('uploads/product/'.$product->product_image)}}" width="100" height="100" style="margin-bottom:10px" />
                                <input type="file" class="form-control" id="exampleInputEmail1"  name="product_image">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả sản phẩm  </label>
                                <textarea style="resize:none" rows="5" class="form-control" id="ckeditor2" placeholder="Mô ta sản phẩm" name="product_desc" >
                                {{$product->product_desc}}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tóm tắt sản phẩm  </label>
                                <textarea style="resize:none" rows="5" class="form-control" id="ckeditor3" placeholder="Tóm tăt sản phẩm" name="product_content" >
                                {{$product->product_content}}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Danh  mục sản phẩm</label>
                                <select class="form-control input-sm m-bot15" name="category_id" >
                                    @foreach ($cate_product as $cate )
                                        @if ($cate->id == $product->category_id)
                                            <option selected value="{{$cate->id}}">{{$cate->category_name}}</option>
                                        @else
                                            <option  value="{{$cate->id}}">{{$cate->category_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Thương hiệu sản phẩm</label>
                                <select class="form-control input-sm m-bot15" name="brand_id" >
                                    @foreach ($brand_products as $brand )
                                        @if ($brand->id==$product->brand_id)
                                            <option selected value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                        @else
                                            <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                        @endif
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
                        @endforeach
                    </div>
                </div>
        </section>
    </div>
</div>
@endsection