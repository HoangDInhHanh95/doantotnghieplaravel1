@extends('welcome')
@section('content')               
            
<div class="features_items">
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

    </style>
<!--features_items-->
    <div class="container-fluid">
        <h2 class="title text-center">Sản phẩm mới</h2>
        @foreach ($all_product as $key => $pro)
        {{-- <a href="{{URL('/chi-tiet-san-pham/'.$pro->product_id)}}"> --}}
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="uploads/product/{{$pro->product_image}}" alt="" />
                            <h2>{{number_format($pro->product_price)}} vnđ</h2>
                            <p>{{$pro->product_name}}</p>
                            <a href="{{URL('/chi-tiet-san-pham/'.$pro->product_id)}}" class="btn btn-default add-to-cart"><i class="fas fa-eye"></i>Xem chi tiết</a>
                        </div>
                        <a href="{{URL('/chi-tiet-san-pham/'.$pro->product_id)}}">
                        <div class="product-overlay">
                            <div class="overlay-content">
                                {{-- <h2>{{number_format($pro->product_price)}} vnđ</h2>
                                <p>{{$pro->product_name}}</p>
                                <a href="{{URL('/gio-hang/'.$pro->product_id)}}" class="btn btn-default add-to-cart"><i class="fas fa-eye"></i>Xem chi tiết</a> --}}
                            </div>
                        </div>
                        </a>
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
        {{-- </a> --}}
        @endforeach
    </div>
</div>
<!-- start Tab product-->
<div class="category-tab">
                       <!--category-tab-->
                        {{-- menu tab product --}}
                       <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tshirt" data-toggle="tab">ÁO VEST</a></li>
                                <li><a href="#blazers" data-toggle="tab">ÁO SƠ MI</a></li>
                                <li><a href="#sunglass" data-toggle="tab">ĐẦM NỮ</a></li>
                                <li><a href="#kids" data-toggle="tab">QUẨN NAM</a></li>
                                <li><a href="#poloshirt" data-toggle="tab">QUẦN ÁO THỂ THAO</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                         {{--start tab tshirt  --}}
                            <div class="tab-pane fade active in" id="tshirt">
                                @foreach ( $ao_vest as $key => $vest )
                                {{-- <a href="{{URL('/chi-tiet-san-pham/'.$vest->product_id)}}"> --}}
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="uploads/product/{{$vest->product_image}}" alt="" />
                                                <h2>{{number_format($vest->product_price)}} vnđ</h2>
                                                <p>{{$vest->product_name}}</p>
                                                <a href="{{URL('/chi-tiet-san-pham/'.$vest->product_id)}}" class="btn btn-default add-to-cart"><i class="fas fa-eye"></i>Xem chi tiế</a>
                                            </div> 
                                        </div>
                                    </div> 
                                </div>
                                {{-- </a> --}}
                                @endforeach
                            </div>
                            {{--end tab tshirt  --}}
                            {{-- start tab ao_so_mi_nam --}}
                            <div class="tab-pane fade" id="blazers">
                                @foreach ( $ao_so_mi_nam as $key => $so_mi_nam )
                                {{-- <a href="{{URL('/chi-tiet-san-pham/'.$so_mi_nam->product_id)}}"> --}}
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="uploads/product/{{$so_mi_nam->product_image}}" alt="" />
                                                <h2>{{number_format($so_mi_nam->product_price)}} vnđ</h2>
                                                <p>{{$so_mi_nam->product_name}}</p>
                                                <a href="{{URL('/chi-tiet-san-pham/'.$so_mi_nam->product_id)}}" class="btn btn-default add-to-cart"><i class="fas fa-eye"></i>Xem chi tiết</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                {{-- </a> --}}
                                @endforeach
                               
                            </div>
                            {{-- end tab blazers --}}
                            {{-- start tab sunglass --}}
                            <div class="tab-pane fade" id="sunglass">

                                @foreach ( $dam_nu as $key => $show_dam_nu )
                                {{-- <a href="{{URL('/chi-tiet-san-pham/'.$show_dam_nu->product_id)}}"> --}}
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="uploads/product/{{$show_dam_nu->product_image}}" alt="" />
                                                <h2>{{number_format($show_dam_nu->product_price)}} vnđ</h2>
                                                <p>{{$show_dam_nu->product_name}}</p>
                                                <a href="{{URL('/chi-tiet-san-pham/'.$vest->product_id)}}" class="btn btn-default add-to-cart"><i class="fas fa-eye"></i>Xem chi tiế</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- </a> --}}
                                @endforeach
                                
                            </div>
                            {{-- send tab sunglass --}}
                            {{-- start tab kids --}}
                            <div class="tab-pane fade" id="kids">
                                @foreach ( $quan_nam as $key => $show_quan_nam )
                                {{-- <a href="{{URL('/chi-tiet-san-pham/'.$show_quan_nam->product_id)}}"> --}}
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="uploads/product/{{$show_quan_nam->product_image}}" alt="" />
                                                <h2>{{number_format($show_quan_nam->product_price)}} vnđ</h2>
                                                <p>{{$show_quan_nam->product_name}}</p>
                                                <a href="{{URL('/chi-tiet-san-pham/'.$vest->product_id)}}" class="btn btn-default add-to-cart"><i class="fas fa-eye"></i>Xem chi tiế</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- </a> --}}
                                @endforeach

                            </div>
                            {{-- start tab poloshirt --}}
                            <div class="tab-pane fade" id="poloshirt">

                                @foreach ( $do_the_thao as $key => $show_do_the_thao)
                                {{-- <a href="{{URL('/chi-tiet-san-pham/'.$show_do_the_thao->product_id)}}"> --}}
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="uploads/product/{{$show_do_the_thao->product_image}}" alt="" />
                                                <h2>{{number_format($show_do_the_thao->product_price)}} vnđ</h2>
                                                <p>{{$show_do_the_thao->product_name}}</p>
                                                <a href="{{URL('/chi-tiet-san-pham/'.$vest->product_id)}}" class="btn btn-default add-to-cart"><i class="fas fa-eye"></i>Xem chi tiế</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- </a> --}}
                                @endforeach
                            </div>
                        </div>
</div>
{{-- end tab product --}}
<!--/category-tab-->
{{-- start product slider --}}
<div class="recommended_items">
                        <!--recommended_items-->
                        <h2 class="title text-center">Sản phẩm để xuất</h2>
                        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="item active">
                                @foreach ($slider_show_product as $key => $slider_show_product_first)
                                {{-- <a href="{{URL('/chi-tiet-san-pham/'.$slider_show_product_first->product_id)}}"> --}}
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{ asset('uploads/product/'.$slider_show_product_first->product_image) }}" alt=""  />
                                                    {{-- <img src="uploads/product/{{$slider_show_product_first->product_image}}" alt="" /> --}}
                                                    <h2>{{number_format($slider_show_product_first->product_price)}} vnđ</h2>
                                                    <p>{{$slider_show_product_first->product_name}}</p>
                                                    <a href="{{URL('/chi-tiet-san-pham/'.$vest->product_id)}}" class="btn btn-default add-to-cart"><i class="fas fa-eye"></i>Xem chi tiết</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                {{-- </a> --}}
                                 @endforeach   
                                </div>
                                <div class="item">
                                    @foreach ($slider_show_product_item as $key => $slider_show_product_second)
                                    {{-- <a href="{{URL('/chi-tiet-san-pham/'.$slider_show_product_second->product_id)}}"> --}}
                                        <div class="col-sm-4">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                    <img src="{{ asset('uploads/product/'.$slider_show_product_second->product_image)}}" alt=""  />
                                                    <h2>{{number_format($slider_show_product_second->product_price)}} vnđ</h2>
                                                    <p>{{$slider_show_product_second->product_name}}</p>
                                                    <a href=""{{URL('/chi-tiet-san-pham/'.$vest->product_id)}} class="btn btn-default add-to-cart"><i class="fas fa-eye"></i>Xem chi tiết</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    {{-- </a> --}}
                                    @endforeach
                                </div>
                            </div>
                            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                                <i class="fas fa-angle-left"></i>
                            </a>
                            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                                <i class="fas fa-angle-right"></i>
                            </a>
                        </div>
</div>
{{-- end product slider --}}
<!--/recommended_items-->
@endsection