@extends('welcome')
@section('content') 
<style type="text/css">
    .productinfo img{
        width: 100%;
        height: 340px;
    }
    .product-image-wrapper{
        border: 1px solid #F7F7F5;
        overflow: hidden;
        margin-bottom: 30px;
        height: 535px;
    }
</style>



<div class="features_items">
    <!--features_items-->
    @foreach ($cate_name as $key => $name_Category_title)
        <h2 class="title text-center">{{$name_Category_title->category_name }}</h2> 
    @endforeach
    {{-- end category name --}}
    @foreach ($category_by_id as $key => $pro)
    <a href="{{URL('/chi-tiet-san-pham/'.$pro->product_id)}}">
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{URL::to('uploads/product/'.$pro->product_image)}}" alt="" />
                        <h2>{{number_format($pro->product_price)}} VNĐ</h2>
                        <p>{{$pro->product_name}}</p>
                        <a href="{{URL('/chi-tiet-san-pham/'.$pro->product_id)}}" class="btn btn-default add-to-cart"><i class="fas fa-eye"></i>Xem chi tiết</a>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            {{-- <h2>{{number_format($pro->product_price)}} VNĐ</h2>
                                    <p>{{$pro->product_name}}</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fas fa-eye"></i>Thêm vào giỏ hàng</a>
                             --}}
                        </div>
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
@endsection