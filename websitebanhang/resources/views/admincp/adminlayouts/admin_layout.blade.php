<!DOCTYPE html>
<head>
<title>Dashboard</title>
 {{-- trinh soan van bản --}}
 {{-- <script src="//cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script> --}}
 {{-- end  --}}
 {{-- token --}}
 <meta name="csrf-token" content="{{csrf_token()}}" >
 {{-- /token --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('css/font.css')}}" type="text/css"/>
<link href="{{asset('css/font-awesome.css')}}" rel="stylesheet"> 
<link rel="stylesheet" href="{{asset('css/morris.css')}}" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="{{asset('css/monthly.css')}}">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="{{asset('js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('js/raphael-min.js')}}"></script>
<script src="{{asset('js/morris.js')}}"></script>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="{{URL('/admincp/quantri    ')}}" class="logo">
       Admin
    </a>
    <div class="sidebar-toggle-box">
        <div class="fas fa-bars"></div>
    </div>
</div>
<!--logo end-->

<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{asset('images/2.png')}}">
                <span class="username">
                    <?php
                        $name = Session::get('admin_name');
                        if($name){
                            echo $name;
                        }
					?>
                </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fas fa-suitcase"></i>Hồ sơ</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Cài đạt</a></li>
                <li><a href="{{URL('/logout') }}"><i class="fas fa-key"></i> Đăng xuất</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!-- dat nhung icon -->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{ url('/admincp/quantri')}}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Tổng quan</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fas fa-book"></i>
                        <span>Danh mục sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('categoryproduct.create')}}">Thêm danh mục sản phẩm</a></li>
						<li><a href="{{route('categoryproduct.index')}}">Liệt kê danh mục sản phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fas fa-copyright"></i>
                        <span>Thương hiệu sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('brand.create')}}">Thêm thương hiệu sản phẩm</a></li>
						<li><a href="{{route('brand.index')}}">Liệt kê thương hiệu sản phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fas fa-pump-soap"></i>
                        <span> Sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('product.create')}}">Thêm  sản phẩm</a></li>
						<li><a href="{{route('product.index')}}">Liệt kê  sản phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fas fa-parachute-box"></i>
                        <span>Đơn hàng</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL('/manager-order-products')}}">Quản lý đơn hàng</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fas fa-band-aid"></i>
                        <span>Slider</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{route('slider.create')}}">Thêm slider banner</a></li>
						<li><a href="{{route('slider.index')}}">Quản lý slider banner</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fas fa-address-card"></i>
                        <span>Danh mục tin tức</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{route('categorynew.create')}}">Thêm danh mục tin tức</a></li>
						<li><a href="{{route('categorynew.index')}}">Quản lý danh mục tin tức</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fas fa-file-alt"></i>
                      
                        <span>Tin tức</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{route('news.create')}}">Thêm tin tức</a></li>
						<li><a href="{{route('news.index')}}">Quản lý tin tức</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fas fa-id-card-alt"></i>
                        <span>Liên hệ</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{ url('/show-contact-page-admin')}}">Quản lý liên hệ</a></li>
                    </ul>
                </li>
            </ul>            
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    {{-- start chỗ chứa trang con --}}
    <section class="wrapper">
        @yield('admin_content')    
    </section>
    {{-- end chỗ chứa trang con --}}
{{-- 
 <!-- footer -->
 <div class="footer">
    <div class="wthree-copyright">
       đây là phần dữ liệu
    </div>
</div>
  <!-- / footer --> --}}
</section>
<!--main content end-->




</section>
<script src="{{ asset('js/bootstrap.js')}}"></script>
<script src="{{ asset('js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{ asset('js/jquery.slimscroll.js')}}"></script>
<script src="{{ asset('js/scripts.js')}}"></script>
<script src="{{ asset('js/jquery.nicescroll.js')}}"></script>

{{-- ckeditor --}}
<script src="{{ asset('backend/ckeditor/ckeditor.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('js/jquery.scrollTo.js')}}"></script>
{{-- gallery --}}
{{-- ckeditor --}}
<script > 
    CKEDITOR.replace('ckeditor');
    CKEDITOR.replace('ckeditor1');


    CKEDITOR.replace('ckeditor2',{
        filebrowserImageUploadUrl : "{{ url('uploads-ckeditor?_token='.csrf_token()) }}",
        filebrowserBrowseUrl : "{{ url('file-browser?_token='.csrf_token()) }}",
        filebrowserUploadMethod: 'form'
    });


    CKEDITOR.replace('ckeditor3',{
        filebrowserImageUploadUrl : "{{ url('uploads-ckeditor?_token='.csrf_token()) }}",
        filebrowserBrowseUrl : "{{ url('file-browser?_token='.csrf_token()) }}",
        filebrowserUploadMethod: 'form'
    });
    
    CKEDITOR.replace('id4');
</script>
{{-- end ckeditor --}}
<script type="text/javascript">
    $(document).ready(function(){
        load_gallery();

        function load_gallery() {
            var pro_id = $(".pro_id").val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url:"{{url('/select-gallery')}}",
                method:"POST",
                data:{pro_id:pro_id,_token:_token},
                success:function(data) {
                    $('#gallery_load').html(data);
                }
            });
        }

        $('#file_gallery').change(function(){
            var error = '';
            // lay so anh. [0] => anh tu 0 den N
            var files = $('#file_gallery')[0].files;

            if(files.length > 7)
            {
                error+= '<p> Bạn chỉ được chọn tối đa là 7 ảnh </p>';
            }else if(files.length == '')
            {
                error+= '<p> Bạn bạn không được để trống ảnh </p>';
            }else if(files.size > 2000000)
            {
                error+= '<p> Kích thước ảnh quá lớn </p>';
            }

            if(error == '')
            {
                
            }else{
               $('#file_gallery').val('');
                $('#error_gallery').html('<span class="text-danger">'+error+'</span>');
                return false;
            }

        });
        
        // sửa tên ảnh cho cac ảnh
        $(document).on('blur','.edit_name_image',function(){
            var gal_id = $(this).data('gal_id');
            var gal_text = $(this).text();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{url('/update-gallery-name')}}",
                method:"POST",
                data:{gal_id:gal_id,gal_text:gal_text,_token:_token},
                success:function(data){
                    load_gallery();
                    $('#error_gallery').html('<span class="text-danger">Cập nhật tên hình ảnh thành công</span>');
                }
            });
        });

        // xóa ảnh trong thư viên ảnh
        $(document).on('click','.delete-gallery',function(){
           var gal_id = $(this).data('gal_id');
           var _token = $('input[name="_token"]').val();
           if(confirm('Bạn chắc là muốn xóa hình ảnh này ?')){
                $.ajax({
                    url:"{{url('/delete-gallery')}}",
                    method:"POST",
                    data:{gal_id:gal_id,_token:_token},
                    success:function(data) {
                        load_gallery();
                        $('#error_gallery').html('<span class="text-danger">Bạn đã xóa hình ảnh thành công</span>');
                    }
                });
           }
        });


        // cap nhat hinh anh trong thu vien hinh anh => đang lỗi
        $(document).on('change','.file_image',function(){
           var gal_id = $(this).data('gal_id');
           var image = document.getElementById('file-'+gal_id).files[0]; // bat id file cua tung image
        //    var _token = $('input[name="_token"]').val();

        var data_form = new FormData();
        data_form.append("file",document.getElementById('file-'+gal_id).files[0]);
        data_form.append("file",gal_id);
          
                $.ajax({
                    url:"{{url('/update-gallery')}}",
                    method:"POST",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                    },
                    data: data_form,
                    contentType:false,
                    cache:false,
                    processData:false,
                    success:function(data) {
                        load_gallery();
                        $('#error_gallery').html('<span class="text-danger">Bạn đã cập nhật hình ảnh thành công</span>');
                    }
                });
           
        });
       
    });



</script>
{{-- /gallery --}}

<!-- morris JavaScript -->	
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
			
			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script>
<!-- calendar -->
	<script type="text/javascript" src="{{asset('js/monthly.js')}}"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script>
	<!-- //calendar -->
</body>
</html>
