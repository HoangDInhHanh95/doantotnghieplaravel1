@extends('welcome')
@section('content')
<div class="features_items">
    <!--features_items-->
        <div class="container-fluid">
            <h2 class="title text-center">Sản phẩm tìm kiếm</h2>
            @foreach ($search_product as $key => $pro)
            <a href="{{URL('/chi-tiet-san-pham/'.$pro->product_id)}}">
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="uploads/product/{{$pro->product_image}}" alt="" />
                                <h2>{{number_format($pro->product_price)}} vnđ</h2>
                                <p>{{$pro->product_name}}</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fas fa-cart-arrow-down"></i>Thêm vào giỏ hàng</a>
                            </div>
                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="#"><i class="fas fa-plus-square"></i>Thêm vào yêu thích</a></li>
                                <li><a href="#"><i class="fas fa-plus-square"></i>So sánh</a></li>
                            </ul>
                        </div>
                    </div> 
                </div>
            </a>
            @endforeach
        </div>
    </div>
@endsection