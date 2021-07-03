@extends('welcome')
@section('content')
<section id="cart_items">
   
       
        <div class="review-payment">
            <h2>Cám ơn bạn đã đạt hàng ở chỗ chúng tôi.Nhân viên bên shop sẽ liên hệ với bạn sơm nhất</h2>
        </div>
        
        <button type="button" class="btn btn-primary btn-sm">
           <a href="{{URL::to('/trang-chu')}}" style="color:#FFFF; font-size: 16px;">
             Tiếp tục mua săm
           </a>
        </button>
     
</section>

@endsection