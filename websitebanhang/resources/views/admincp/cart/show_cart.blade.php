@extends('welcome')
@section('content')

        <section id="cart_items">
            
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                      <li><a href="#">home</a></li>
                      <li class="active">Giỏ hàng của bạn</li>
                    </ol>
                </div>
                <div class="table-responsive cart_info">
                   
                    <?php
                        $content = Cart::content();
                        // echo '<pre>';
                        //     print_r($content);
                        // echo '</pre>';
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

        </section> <!--/#cart_items-->
        <section id="do_action">
          
                {{-- <div class="heading">
                    <h3>What would you like to do next?</h3>
                    <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
                </div> --}}
                <div class="row">
                    {{-- <div class="col-sm-6">
                        <div class="chose_area">
                            <ul class="user_option">
                                <li>
                                    <input type="checkbox">
                                    <label>Use Coupon Code</label>
                                </li>
                                <li>
                                    <input type="checkbox">
                                    <label>Use Gift Voucher</label>
                                </li>
                                <li>
                                    <input type="checkbox">
                                    <label>Estimate Shipping & Taxes</label>
                                </li>
                            </ul>
                            <ul class="user_info">
                                <li class="single_field">
                                    <label>Country:</label>
                                    <select>
                                        <option>United States</option>
                                        <option>Bangladesh</option>
                                        <option>UK</option>
                                        <option>India</option>
                                        <option>Pakistan</option>
                                        <option>Ucrane</option>
                                        <option>Canada</option>
                                        <option>Dubai</option>
                                    </select>
                                    
                                </li>
                                <li class="single_field">
                                    <label>Region / State:</label>
                                    <select>
                                        <option>Select</option>
                                        <option>Dhaka</option>
                                        <option>London</option>
                                        <option>Dillih</option>
                                        <option>Lahore</option>
                                        <option>Alaska</option>
                                        <option>Canada</option>
                                        <option>Dubai</option>
                                    </select>
                                
                                </li>
                                <li class="single_field zip-field">
                                    <label>Zip Code:</label>
                                    <input type="text">
                                </li>
                            </ul>
                            <a class="btn btn-default update" href="">Get Quotes</a>
                            <a class="btn btn-default check_out" href="">Continue</a>
                        </div>
                    </div> --}}
                    <div class="col-sm-6">
                        <div class="total_area">
                            <ul>
                                <li>Tổng<span>{{Cart::total().' '.'vnđ'}}</span></li>
                                <li>Thuế <span>{{Cart::tax().' '.'vnđ'}}</span></li>
                                <li>Phí vận chuyển <span>Free</span></li>
                                <li>Tổng tiền <span>{{Cart::total().' '.'vnđ'}}</span></li>
                            </ul>
                                {{-- <a class="btn btn-default update" href="">Update</a> --}}
                                <?php
                                $customer_id = Session::get('customer_id');
                                if($customer_id == null){
                            ?>
                               <a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Thanh toán</a>
                            <?php
                                }else{
                            ?>
                              
                              <a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Thanh toán</a>
                                
                            <?php
                                };
                            ?>
                                
                        </div>
                    </div>
                </div>
        
        </section><!--/#do_action-->


@endsection