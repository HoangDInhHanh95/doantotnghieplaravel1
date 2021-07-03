@extends('welcome')
@section('content')
<style type="text/css">
    .choose ul li.wishlist {
        color: #504f4d;
        font-family: 'Roboto', sans-serif;
        font-size: 13px;
        padding-left: 0;
        padding-right: 0
    }
    .choose ul li.wishlist input{
        background: none;
        font-size: 14px;
    }
    .choose ul li.wishlist:hover{
        color: #FE980F;
    }
    .choose ul li.wishlist input:hover{
        color: #FE980F;
    }
    .productinfo img{
        width: 100%;
        height: 350px;
    }

</style>
    <div class="features_items"><!--features_items-->
        @foreach ($all_product as $key => $pro)
        <a href="{{URL('/chi-tiet-san-pham/'.$pro->product_id)}}">
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="uploads/product/{{$pro->product_image}}" alt="" />
                            <h2>{{number_format($pro->product_price)}} vnđ</h2>
                            <p>{{$pro->product_name}}</p>
                            <a href="{{URL('/chi-tiet-san-pham/'.$pro->product_id)}}" class="btn btn-default add-to-cart"><i class="fas fa-eye"></i>Xem chi tiết</a>
                        </div>
                    </div>
                    <div class="choose">
                        <form action="{{URL('/add-wishlist/'.$pro->product_id)}}" method="POST">
                            @csrf
                        <ul class="nav nav-pills nav-justified">
                                <li class="wishlist "><i class="fas fa-plus-square "></i><input  type="submit" class="btn btn-xs"  value="Thêm vào yêu thích"></li>
                            </form>
                            <li><a href="#"><i class="fas fa-plus-square"></i>So sánh</a></li>
                        </ul>
                    </div>
                </div> 
            </div>
        </a>
        @endforeach
    </div><!--features_items-->

    <div class="setting_pagination">
        {!! $all_product->links() !!}
    </div>
@endsection