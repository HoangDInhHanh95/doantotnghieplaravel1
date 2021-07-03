@extends('welcome')
@section('content')
<section id="cart_items">
   
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Thanh toán giở hàng</li>
            </ol>
        </div><!--/breadcrums-->

        
        

        <div class="register-req">
            <p>Làm ơn đăng ký hoặc đăng nhập để thanh toán và xem lại lịch sử mua hàng</p>
        </div><!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                
                <div class="col-sm-12 clearfix">
                    <div class="bill-to">
                        <p>Điền thông tin gửi hàng</p>
                        <div class="form-one">
                            <form method="POST" action="{{URL('/save-cart-checkout')}}">
                                @csrf
                                <input type="text" name="shipping_email" placeholder="Email*" class="form-control">
                                <input type="text"  name="shipping_name"  placeholder="Họ và tên " class="form-control">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Size sản phẩm</label>
                                    <select class="form-control input-sm m-bot15" name="shipping_size" >
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn màu sắc</label>
                                    <select class="form-control input-sm m-bot15" name="shipping_color" >
                                        <option value="Đỏ">Đỏ</option>
                                        <option value="Cam">Cam</option>
                                        <option value="Vàng">Vàng</option>
                                        <option value="Xanh da trời">Xanh da trời</option>
                                        <option value="Trắng">Trắng</option>
                                        <option value="Đen">Đen</option>
                                        <option value="Tím"></option>
                                    </select>
                                </div>                         
                                <input type="text" name="shipping_address"  placeholder="Địa chỉ nhận hàng" class="form-control">
                                <input type="text" name="shipping_phone"  placeholder="Số điện thoại" class="form-control">
                                <div class="order-message">
                                    <p>Ghi chú khi đặt hàng</p>
                                    <textarea name="shipping_note"  placeholder="Ghi chú đơn hàng của bạn" rows="10" class="form-control"></textarea>
                                </div>
                                <input type="submit" value="Đặt hàng" style="background-color:#fdb45e; font-size: 16px; color: #000000; font-weight:bold;" name="send_order_product" class="btn  btn-sm">
                            </form>
                        </div>
                        
                    </div>
                </div>
               					
            </div>
        </div>
</section> <!--/#cart_items-->

@endsection