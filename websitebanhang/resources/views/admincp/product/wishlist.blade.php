@extends('welcome')
@section('content') 
<div class="features_items">
    <!--features_items-->
        <h2 class="title text-center">Sản phẩm yêu thích</h2> 
    {{-- end category name --}}
    @foreach ($show_wishlist as $key => $wishlist)
    <a href="{{URL('/chi-tiet-san-pham/'.$wishlist->product_id)}}">
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{URL::to('uploads/product/'.$wishlist->product_image)}}" alt="" />
                        <h2>{{number_format($wishlist->product_price)}} vnđ</h2>
                        <p>{{$wishlist->product_name}}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fas fa-cart-arrow-down"></i>Thêm vào giỏ hàng</a>
                    </div>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fas fa-plus-square"></i>Bỏ yêu thích</a></li>
                        <li><a href="#"><i class="fas fa-plus-square"></i>So sánh</a></li>
                    </ul>
                </div>
            </div> 
        </div>
    </a>
    @endforeach
   
    <?php
        $get_id_product = Session::get('product_id');
        echo $get_id_product;
    ?>
</div>
@endsection