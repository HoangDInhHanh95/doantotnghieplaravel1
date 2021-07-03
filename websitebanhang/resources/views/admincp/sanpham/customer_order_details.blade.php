@extends('welcome')
@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
       Đơn hàng của bạn
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
        <div class="col-sm-3">
          
          {{-- <div class="input-group">
            <input type="text" class="input-sm form-control" placeholder="Search">
            <span class="input-group-btn">
              <button class="btn btn-sm btn-default" type="button">Go!</button>
            </span>
          </div> --}}
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
              <th>Tình trang đơn hàng</th>
              <th>Chức năng</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
         @foreach ($customer_order_details as $v_order_details)
            <tr>
              <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
              <td>{{$v_order_details->order_details_id}}</td>
              <td>{{$v_order_details->shipping_name}}</td>
              <td>{{$v_order_details->product_name}}</td>
              <td><img src="{{URL('uploads/product/'.$v_order_details->product_image)}}" width="100" height="100"/></td>
              <td>{{$v_order_details->shipping_size}}</td>
              <td>{{$v_order_details->shipping_color}}</td>
              <td>{{$v_order_details->shipping_address}}</td>
              <td>{{$v_order_details->shipping_phone}}</td>
              <td>{{$v_order_details->product_sales_quantity}}</td>
              {{-- setting method check payment --}}
              <td>
                <?php
                  if($v_order_details->payment_method == 2){
                      echo "Thanh toán bằng tiền mặt";
                  }else if($v_order_details->payment_method == 1){
                    echo "Thanh toán bằng ATM";
                  }else {
                    echo "Thanh toán bằng MoMo";
                  }
                ?>
              </td>
               {{-- /setting method check payment --}}
              <td><span class="text-ellipsis">{{$v_order_details->order_total}} vnđ</span></td>
                <?php
                 if($v_order_details->order_status == 0){
                ?>
                  <td style="color:red; font-family: 'Times New Roman', Times, serif; font-weight: bold">Chờ lấy hàng </td>
                <?php
                 }else{
                ?>
                  <td style="color:red; font-family: 'Times New Roman', Times, serif; font-weight: bold">Đăng chờ phê duyệt </td>
                <?php } ?>
                
                
              <td>
              {{-- Delete product details --}}
                 <form action="{{url('/delete-order-details/'.$v_order_details->order_details_id)}}"  method="POST">
                    {{-- @method('DELETE') --}}
                      @csrf
                      <button class="btn btn-default" onclick="return confirm('Bạn chắc là muốn hủy đơn hàng')" >
                        <i class="fas fa-trash-alt text-danger"></i>
                      </button>
                </form> 
                {{-- /Delete product details --}}
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">
          
          <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm">Hiển thị 6 đơn hàng trong số mặt hàng đã mua</small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
           {!! $customer_order_details->links() !!}
          </div>
        </div>
      </footer>
    </div>
</div>







@endsection