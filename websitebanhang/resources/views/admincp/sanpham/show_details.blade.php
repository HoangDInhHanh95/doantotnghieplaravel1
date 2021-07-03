@extends('welcome')
@section('content')
@foreach ($details_product as $key =>$show_details_product)
  <style type="text/css">

        .lSSlideOuter .lSPager.lSGallery img {
            display: block;
            height: 100px;
            max-width: 100%;
        }
        li.active {
            border: 2px solid #FE980F;
        }
        .category-tab ul{
            background:none;
        }
  </style>  

<div class="product-details"><!--product-details-->
    <div class="col-sm-5">
        {{--gallery product --}}
        <ul id="imageGallery">
            @foreach ($gallery_show as $key => $value_gallery)
                <li data-thumb="{{asset('uploads/gallery/'.$value_gallery->gallery_image)}}" data-src="{{asset('uploads/gallery/'.$value_gallery->gallery_image)}}" >
                <img style="width: 100%; height:100%" src="{{asset('uploads/gallery/'.$value_gallery->gallery_image)}}"  alt="{{$value_gallery->gallery_name}}"/>
                </li>
            @endforeach
        </ul>

    </div>
    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
            <img src="images/product-details/new.jpg" class="newarrival" alt="" />
            <h2>{{$show_details_product->product_name}}</h2>
            <p>Mã sản phẩm: {{$show_details_product->product_id}}</p>
            <img src="images/product-details/rating.png" alt="" />
            {{-- sent to show cart --}}
            <form action="{{URL('/save-cart')}}" method="POST">
                @csrf
                <span>
                    <span>{{number_format($show_details_product->product_price)}}  VNĐ</span>
                </span>
                <span>
                    <label>Số lượng:</label>
                    <input name="qty" type="number" min="1" value="1" />
                    <input name="productid_hidden" type="hidden"  value="{{$show_details_product->product_id}}" />
                    <button type="submit" class="btn btn-fefault cart">
                        <i class="fas fa-eye"></i>
                        Thêm giỏ hàng
                    </button>
                </span>  
            </form> 
              {{-- /sent to show cart --}}
            <p><b>Tình trạng:</b> Còn hàng</p>
            <p><b>Sản phẩm:</b> New</p>
            <p><b>Thương hiệu:</b> {{$show_details_product->brand_name}}</p>
            <p><b>Danh mục:</b> {{$show_details_product->category_name}}</p>
            <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
        </div><!--/product-information-->
    </div>
</div><!--/product-details-->

{{-- category tab --}}
<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#details" data-toggle="tab">Mô tả sản phẩm</a></li>
            {{-- <li><a href="#companyprofile" data-toggle="tab">Bình luận</a></li> --}}
            <li ><a href="#reviews" data-toggle="tab">Đánh gia (&#9733;)</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in " id="details" >
            {!!$show_details_product->product_desc!!} 
        </div>
        {{-- phân để cho binh luân --}}
        <div class="tab-pane fade" id="companyprofile" >
           
        </div>
         {{-- /phân để cho binh luân --}}
        <div class="tab-pane fade " id="reviews" >
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fas fa-users"></i>EUGEN</a></li>
                    <li><a href=""><i class="fas fa-clock"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fas fa-calendar-week"></i>31 DEC 2014</a></li>
                </ul>

                {{-- đang bị lỗi --}}
                <p><b>Đánh giá sao</b></p>
                <form action="{{URL('/insert-rating')}}" method="post">
                    {{-- @csrf --}}
                    <ul class="list-inline" title="Average Rating">
                        @for ($count =1; $count <= 5; $count++)
                            @php
                                if($count <= $rating)
                                    $color = 'color: #ffcc00;';
                                else
                                    $color = 'color: #ccc;';
                            @endphp
                            <li title="Đánh giá sao" id="{{$show_details_product->product_id}}-{{$count}}" data-index ="{{$count}}" data-product_id="{{$show_details_product->product_id}}" data-rating="{{$rating}}" class="rating" style="{{$color}}font-size: 30px; cursor:pointer;">&#9733;</li>
                        @endfor

                    </ul>
                </form>
                {{-- end đanh gia sao  --}}
                {{-- <p><b>  </b></p>
                <form action="#">
                    <span>
                        <input type="text" placeholder="Your Name"/>
                        <input type="email" placeholder="Email Address"/>
                    </span>
                    <textarea name="" ></textarea>
                    <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                    <button type="button" class="btn btn-default pull-right">
                        Submit
                    </button>
                </form> --}}

            </div>
        </div>
        
    </div>
</div>
@endforeach
<!--/category-tab-->
{{-- end category table --}}

{{-- sản liên quan  --}}
<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">Sản phẩm gợi ý</h2>
    
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
            @foreach ($related_product as $key =>$related)
            <a href="{{URL('/chi-tiet-san-pham/'.$related->product_id)}}">
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{URL('uploads/product/'.$related->product_image)}}" alt="" />
                                <h2>{{ number_format($related->product_price) }} vnđ</h2>
                                <p>{{$related->product_name}}</p>
                                
                                <button type="button" class="btn btn-default add-to-cart"><i class="fas fa-eye"></i>Xem chi tiết</button>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach	
            </div>
            <div class="item">

            @foreach ($related_product_item as $key =>$item_product)
            {{-- <a href="{{URL('/chi-tiet-san-pham/'.$item_product->product_id)}}"> --}}
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{URL('uploads/product/'.$item_product->product_image)}}" alt="" />
                                <h2>{{$item_product->product_price}}</h2>
                                <p>{{$item_product->product_name}}</p>
                                <a href="{{URL('/chi-tiet-san-pham/'.$item_product->product_id)}}">
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fas fa-eye"></i>Xem chi tiết</button>
                                </a>
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
</div><!--/recommended_items-->
 {{-- kết thúc sản phâm liên quan --}}

@endsection