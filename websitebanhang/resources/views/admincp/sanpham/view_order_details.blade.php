@extends('admincp.adminlayouts.admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
       Chi tiết đơn hàng
      </div>
      <div class="row w3-res-tb">
      {{-- status thông báo lỗi --}}
        @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        @endif 
        <div class="col-sm-4">
        </div>
        
      </div>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
            <th></th>
              <th>Mã đơn hàng</th>
              <th>Khách hàng</th>
              <th>Sản phẩm</th>
              <th>Hình ảnh</th>
              <th>size</th>
              <th>Màu sắc</th>
              <th> Địa chỉ</th>
              <th>Số điện thoại</th>
              <th>Số lượng</th>
              <th>Phương thức thanh toán</th>
              <th>Tổng tiền</th>
              <th>Tình trạng đơn hàng</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
            <tr>
              <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
              <td>{{$order_details_product->order_details_id}}</td>
              <td>{{$order_details_product->shipping_name}}</td>
              <td>{{$order_details_product->product_name}}</td>
              <td><img src="{{URL('uploads/product/'.$order_details_product->product_image)}}" width="100" height="100"/></td>
              <td>{{$order_details_product->shipping_size}}</td>
              <td>{{$order_details_product->shipping_color}}</td>
              <td>{{$order_details_product->shipping_address}}</td>
              <td>{{$order_details_product->shipping_phone}}</td>
              <td>{{$order_details_product->product_sales_quantity}}</td>
              <td>
                <?php
                  if($order_details_product->payment_method == 2){
                      echo "Thanh toán bằng tiền mặt";
                  }else if($order_details_product->payment_method == 1){
                    echo "Thanh toán bằng ATM";
                  }else {
                    echo "Thanh toán bằng MoMo";
                  }
                ?>
              </td>
              <td><span class="text-ellipsis">{{$order_details_product->order_total}} vnđ</span></td>
                  <?php
                      if($order_details_product->order_status == 0){
                  ?>
                        <td style="color:red; font-family: 'Times New Roman', Times, serif; font-weight: bold">Chờ lấy hàng </td>
                  <?php
                      }else{
                  ?>
                        <td style="color:red; font-family: 'Times New Roman', Times, serif; font-weight: bold">Đăng chờ phê duyệt </td>

                  <?php } ?>
                  
            </tr>
          </tbody>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">
         
        </div>
      </footer>
    </div>
</div>
@endsection