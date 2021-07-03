

<!------template index----------->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    
    {{-- token --}}
    {{-- <meta name="csrf-token" content="{{csrf_token()}}" > --}}
    {{-- /token --}}

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    {{-- trinh soan van bản --}}
    <script src="//cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    {{-- end  --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/prettyPhoto.css')}}" rel="stylesheet"{>
    <link href="{{asset('css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/main.css')}}" rel="stylesheet">
    <link href="{{asset('css/responsive.css')}}" rel="stylesheet">

    {{-- css lighslider trong chi tiêt sản phẩm --}}
    <link href="{{asset('css/lightgallery.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/lightslider.css')}}" rel="stylesheet">
    <link href="{{asset('css/prettify.css')}}" rel="stylesheet">
    {{-- js lightslider trong chi tiết sản phẩm --}}

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">

    {{-- link slider swiper --}}
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>

</head>
<!--/head-->

<body>
   
    <header id="header">
        <!--header-->
        <div class="header_top">
            <!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fas fa-phone-alt"></i> 0368661392</a></li>
                                <li><a href="#"><i class="fas fa-envelope"></i> HoangDinhHanh@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fab fa-facebook-f" ></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fab fa-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header_top-->

        <div class="header-middle">
            <!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="index.html"><img src="images/home/logo.png" alt="" /></a>
                        </div>
                        <div class="btn-group pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canada</a></li>
                                    <li><a href="#">UK</a></li>
                                </ul>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canadian Dollar</a></li>
                                    <li><a href="#">Pound</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <?php 
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id != null){
                                ?>
                                <li><a href="{{url('/show-wishlist')}}"><i class="fas fa-star"></i>Yêu thích</a></li>
                                <?php }else{ ?>
                                    <li><a href="{{URL::to('/login-checkout')}}"><i class="fas fa-lock"></i>Yêu thích</a></li>

                                <?php } ?>
                                <?php
                                    
                                    $shipping_id = Session::get('shipping_id'); 
                                    $customer_id = Session::get('customer_id');
                                    // echo  $customer_id;
                                    if($customer_id == null){
                                ?>
                                   <li><a href="{{URL::to('/login-checkout')}}"><i class="fas fa-crosshairs"></i>Thanh toán</a></li>
                                <?php
                                    }else{
                                ?>
                                    <li>
                                        <li><a href="{{URL::to('/Show-cart')}}"><i class="fas fa-crosshairs"></i>Thanh toán</a></li>
                                    </li>
                                <?php
                                    };
                                ?>
                                
                                <li><a href="{{URL('/Show-cart')}}"><i class="fas fa-shopping-cart"></i> Giỏ hang</a></li>
                                <?php
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id == null){
                                ?>
                                    <li><a href="{{URL::to('/login-checkout')}}"><i class="fas fa-lock"></i>Đăng nhập</a></li>
                                <?php
                                    }else{
                                ?>
                                {{-- start --}}

                                <li class="dropdown">
                                    <a href="#"> 
                                        <i class="fas fa-user" id="icon_menu"></i>
                                           <?php
                                                $customer_id = Session::get('customer_id');
                                                
                                                if($customer_id)
                                                {
                                                    $get_customer_name = Session::get('customer_name');
                                                    echo $get_customer_name;
                                                } 
                                           ?>
                                        {{-- <i class="fas fa-angle-down"></i> --}}
                                    </a>
                                    <ul role="menu" id="sub-menu-one">
                                        <li>
                                            <a href="{{URL::to('/logout-checkout')}}">
                                                <i class="fas fa-lock-open "></i>
                                                Đăng xuất
                                            </a>
                                        </li>
                                        <li><a href="{{URL('/customer-order-details')}}"><i class="fas fa-box-open"></i></i>Đơn mua</a></li>
                                    </ul>
                                </li>
                                {{-- end --}}
                                <?php
                                    };
                                ?>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-middle-->

        <div class="header-bottom">
            <!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{URL::to('/trang-chu')}}" class="active">
                                    <i class="fas fa-home " id="icon_menu"></i>
                                    Trang Chủ</a></li>
                                <li class="dropdown">
                                    
                                    <a href="#"> 
                                        <i class="fas fa-vest-patches" id="icon_menu"></i>
                                            Thời Trang
                                        <i class="fas fa-angle-down"></i>
                                    </a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="{{url('/show-all-product')}}">Sản phẩm</a></li>
                                        {{-- <li><a href="product-details.html">Product Details</a></li>
                                        <li><a href="checkout.html">Checkout</a></li>
                                        <li><a href="cart.html">Cart</a></li>
                                        <li><a href="login.html">Login</a></li> --}}
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">
                                    <i class="fas fa-newspaper" id="icon_menu"></i>
                                    Tin Tức
                                    <i class="fas fa-angle-down"></i></a>
                                     <ul role="menu" class="sub-menu">
                                        @foreach ($show_cate_new as $cate_news_item)
                                             <li><a href="{{url('/show-cate-news/'.$cate_news_item->cate_news_id)}}">{{ $cate_news_item->cate_news_name }}</a></li>
                                        @endforeach 
                                    </ul>
                                </li>

                                {{-- <li><a href="contact-us.html"><i class="fas fa-newspaper" id="icon_menu"></i>Tin Tức</a></li> --}}
                                <li><a href="{{url('/view-contact') }}"><i class="fas fa-phone " id="icon_menu"></i>Liên Hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- chua hien icon search -->
                    <div class="col-sm-4">
                       <form action="{{URL('/search-product')}}" method="POST">
                           @csrf
                           <div class="search_box pull-right">
                                <input type="text" name="search_produ" placeholder="Bạn muốn tìm gì ?" />
                                <input type="submit" value="Tìm kiếm" class="btn btn-small" id="search_product">
                            </div>
                       </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-bottom-->
    </header>
    <!--/header-->

    <section id="slider">
        <!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>

                        <div class="carousel-inner">
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($show_slider_home as $v_slider)
                            @php
                                $i++;
                            @endphp
                          {{-- uploads/sliderimage/{{$v_slider->slider_image}} --}}
                            <div class="item {{$i==1 ? 'active' : ''}}">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>{{$v_slider->slider_title}}</h2>
                                    <p>{{$v_slider->slider_desc}}</p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{asset('uploads/sliderimage/'.$v_slider->slider_image)}}" class="img img-responsive" alt="" style="width:100%;" />
                                    {{-- <img src="{{asset('images/pricing.png')}}" class="pricing" alt="" /> --}}
                                </div>
                            </div>
                            @endforeach 

                           

                        </div>

                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            {{-- <i class="fas fa-angle-left"></i> --}}
                            <i class="fas fa-chevron-left   "></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--/slider-->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Trang phục</h2>
                        <div class="panel-group category-products" id="accordian">
                           
                            @foreach ($category as $key => $cate)
                            <div class="panel panel-default">
                                <div class="panel-heading">   
                                    <h4 class="panel-title"><a href="{{URL('/danh-muc-san-pham/'.$cate->id)}}">{{$cate->category_name}}</a></h4>
                                </div>
                            </div>
                            @endforeach 
                        </div>
                        <!--/category-products-->

                        <div class="brands_products">
                            <!--brands_products-->
                            <h2>Thương hiệu</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    @foreach ($brand_products as $key =>$brand)
                                        <li>
                                            <a href="{{URL('/thuong-hieu-san-pham/'.$brand->id)}}"> <span class="pull-right">(50)</span>{{$brand->brand_name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            
                        </div>
                        <!--/brands_products-->

                        {{-- <div class="price-range">
                            <!--price-range-->
                            <h2>Price Range</h2>
                            <div class="well text-center">
                                <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2"><br />
                                <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                            </div>
                        </div> --}}
                        <!--/price-range-->

                        <div class="shipping text-center">
                            <!--shipping-->
                            <img src="{{asset('images/shipping.jpg')}}" alt="" />
                        </div>
                        <!--/shipping-->

                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    
                <!-- chua trang home -->
                    @yield('content')
                </div>
            </div>
        </div>
    </section>

    <footer id="footer">
        <!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="companyinfo">
                            <h2><span>e</span>-shopper</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('images/iframe1.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="far fa-play-circle"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('images/iframe2.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('images/iframe3.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('images/iframe4.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="address">
                            <img src="{{asset('images/map.png')}}" alt="" />
                            <p>Shop được đặt tại Việt Nam</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Dịch vụ </h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Hỗ trợ trực tuyến</a></li>
                                <li><a href="#">Liên hệ chúng tôi</a></li>
                                <li><a href="#">Tình trạng đặt hàng</a></li>
                                <li><a href="#">Thay đổi địa điểm</a></li>
                                <li><a href="#">Câu hỏi thường gặp </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Cửa hàng nhanh chóng</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Áo sơ mi</a></li>
                                <li><a href="#">Áo vest nam</a></li>
                                <li><a href="#">Đâm nữ</a></li>
                                <li><a href="#">Quần nam</a></li>
                                <li><a href="#">Quần áo thể thao</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Chính sách</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Điều khoản sử dụng </a></li>
                                <li><a href="#">Chính sách bảo mật</a></li>
                                <li><a href="#">Chính sách hoàn lại tiền</a></li>
                                <li><a href="#">Hệ thống thanh toán</a></li>
                                <li><a href="#">Hệ thống vé </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Giới thiệu về Shopper</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Thông tin công ty</a></li>
                                <li><a href="#">Nghề nghiệp </a></li>
                                <li><a href="#">Vị trí cửa hàng </a></li>
                                <li><a href="#">Chương trình liên kết</a></li>
                                <li><a href="#">Bản quyền </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>Giới thiệu về Shopper</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Your email address" />
                                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Nhận các bản cập nhật gần đây nhất từ <br /> trang web của chúng tôi và được cập nhật bản thân của bạn ... </p>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Bản quyền © 2021 E-SHOPPER Inc. Mọi quyền được bảo lưu. </p>
                    <p class="pull-right">Thiết kế bởi <span><a target="_blank" href="#">Hoàng Đình Hanh</a></span></p>
                </div>
            </div>
        </div>

    </footer>
    <!--/Footer-->

    {{-- start thử đương links --}}
    <script src ="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    {{--kết thưc thử ajax --}}
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('js/price-range.js')}}"></script>
    <script src="{{asset('js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>

    {{-- lighslider trong chi tiết sản phẩm --}}
    <script src="{{asset('js/lightgallery-all.min.js')}}"></script>
    <script src="{{asset('js/lightslider.js')}}"></script>
    <script src="{{asset('js/prettify.js')}}"></script>
    {{-- start đánh giá sao  bên trang details product--}}
    <script type="text/javascript">
        function remove_background(product_id)
        {
            for(var count = 1; count <= 5; count++)
            {
                $('#'+product_id+'-'+count).css('color', '#ccc');
            }
        }

        // sử dụng Ajax để hover chuột vào sao -- mouseentor giống dạng hover
        $(document).on('mouseenter','.rating',function(){
            var index = $(this).data('index');
            var product_id = $(this).data('product_id');
           
            remove_background(product_id);

            // vòng lập setting màu vàng cho sao
            for(var count = 1; count <= index; count++)
            {
               $('#'+product_id+'-'+count).css('color', '#ffcc00');
            }
        });

        // nhả chuột không đánh giá sao
        $(document).on('mouseleave','.rating',function(){
            var index = $(this).data('index');
            var product_id = $(this).data('product_id');
            var rating = $(this).data('rating'); // => rating là số đếm trung bình có trung table tbl_rating => giá trị sao hiện tại

            //function trả về cái màu sao cũ => #ccc => nâu
            remove_background(product_id);

            for(var count = 1; count <= rating; count++)
            {
                $('#'+product_id+'-'+count).css('color', '#ffcc00');
            }
        });

        // click để đánh giá sao cho sản phẩm => đang lỗi
        $(document).on('click','.rating',function(){
            var index = $(this).data('index');
            var product_id = $(this).data('product_id');
            var _token = $('input[name="_token"]').val();
            // alert(_token);
            $.ajax({
                url: "{{ url('insert-rating') }}",
                method:"POST",
                data:{index:index, product_id:product_id,_token:_token},
                success:function(data) 
                {
                    if(data == 'done')
                    {
                        alert('Bạn đã đánh giá sản phẩm này' + index + 'trên 5 sao'),
                    }else{
                      alert('Lỗi đánh giá sao');   
                    }
                }
            });
        });

    </script>
    {{-- end đánh giá sao --}}
    {{-- start chat message facebook  chưa được phê duyệt--}}

    <!-- Messenger Plugin chat Code  -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "106548807643917");
      chatbox.setAttribute("attribution", "biz_inbox");
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v11.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>

    {{-- end chat message --}}
    {{-- code chay slider gallery --}}
    <script type="text/javascript">
    $(document).ready(function() {
    $('#imageGallery').lightSlider({

        gallery:true, // mã code chay nhiêu hình ảnh
        item:1, // click là chạy 1 item
        loop:true, // vòng lập
        thumbItem:3, // hiện thị số ảnh show ra và ảnh con bên dưới
        slideMargin:0,
        enableDrag: false,
        currentPagerPosition:'left',
        onSliderLoad: function(el) {
            el.lightGallery({
                selector: '#imageGallery .lslide'
            });
        }   
    });  
  });
    </script>

</body>

</html>
