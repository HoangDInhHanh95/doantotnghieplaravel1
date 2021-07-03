@extends('welcome')
@section('content')
<section id="cart_items">
   
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div><!--/breadcrums-->
        <div class="review-payment">
            <h2>Xem lại đơn hàng</h2>
        </div>
        {{-- giỏ hang trang payment --}}
        <div class="table-responsive cart_info">    
            <?php
                $content = Cart::content();
               
            ?>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td class="description">Sản phẩm</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($content as $value_pro_info_cart)
                        

                    <tr>
                        <td class="cart_product">
                            <a href="">
                                <img src="{{URL('uploads/product/'.$value_pro_info_cart->options->image)}}" alt="" width="80">
                            </a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$value_pro_info_cart->name}}</a></h4>
                            <h5>ID: {{$value_pro_info_cart->id}}</h5>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($value_pro_info_cart->price)}} VNĐ</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form method="POST" action="{{URL('/update-cart-qty')}}">
                                    @csrf
                                    <input class="cart_quantity_input" type="text" name="quantity" value="{{$value_pro_info_cart->qty}}" autocomplete="off" size="2" min="1" >
                                    
                                    {{-- lấy gia trị rowId cua san pham cart --}}
                                    <input type="hidden" value="{{$value_pro_info_cart->rowId}}" name="rowId_cart" class="form-control">

                                    <input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm">
                                </form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                <?php
                                    $subtotal = $value_pro_info_cart->price * $value_pro_info_cart->qty;
                                    echo number_format($subtotal).' '.'VNĐ';
                                ?>
                            </p>
                        </td>
                        <td class="cart_delete">
                           
                            <a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$value_pro_info_cart->rowId)}}"> 
                                <i class="fas fa-times"></i>
                            </a>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- /end payment --}}
        
        <div class="review-payment">
            <h2>Chọn hình thức thanh toán</h2>
        </div>
        <br>
        <div class="payment-options" >
            <form method="POST" action="{{URL('/payment-method-order')}}">
                @csrf
                <span>
                    <label><input name="payment_option"  value="1" type="checkbox"> Thanh toán bằng thẻ ATM</label>
                </span>
                <span>
                    <label><input name="payment_option" value="2" type="checkbox"> thanh toán khi nhận hàng</label>
                </span>
                <span>
                    <label><input name="payment_option" value="3" type="checkbox"> thanh toán qua MoMo</label>
                </span>
                <span>
                    <input type="submit" value="Đặt hàng" style="background-color:#FE980F; font-size: 16px; color: #ffffff; font-weight:bold;" name="payment_order_method" class="btn  btn-sm">
                </span>
            </form> 
        </div>

</section> <!--/#cart_items-->

@endsection