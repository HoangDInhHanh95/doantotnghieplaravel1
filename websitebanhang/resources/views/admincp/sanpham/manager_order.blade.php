@extends('admincp.adminlayouts.admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Quản lý đơn hàng
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
              <th>Tên người đặt</th>
              <th>Hình thức thanh toán</th>
              <th>tổng tiền</th>
              <th>Trang thái</th>
              <th>Ngày đặt hàng</th>
              <th>Chức năng</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
          @foreach ($order_customer_product as $item)
            <tr>
              <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
              <td>{{$item->order_id}}</td>
              <td>{{$item->shipping_name}}</td>
              <td>
                  <?php
                    if ($item->payment_method == 2) {
                        echo 'Thanh toán bằng tiền mặt';
                    }elseif($item->payment_method == 1)
                    {
                        echo 'Thanh toán bằng thẻ ATM';
                    }else{
                        echo 'Thanh toán bằng MoMo';
                    }
                  ?>
              </td>
              <td>{{ $item->order_total}} vnđ</td>
              <td>
              {{--start status product --}}
                {{-- 1 đang chờ phê duyệt, 0 cho phép đạt hàng --}}
              @if($item->order_status == 1) 
                Đang chờ phê duyệt <br>
                <a href="{{URL('/active-order',$item->order_id)}}">
                    <span class="fa-thumb-styling fas fa-check-square text-success"></span>
                </a>
              @else
                  Đơn hàng đã được phê duyệt <br>
                  <a href ="{{URL('/unactive-order',$item->order_id)}}">
                    <button class="btn btn-default">
                      <span class="fa-thumb-styling fas fa-times text-danger "></span>
                    </button>
                  </a>
              @endif
              {{-- end start status order --}}
              </td>
                <td><span class="text-ellipsis">{{$item->created_at}} </span></td>
              <td>
                {{-- start delete order in page admin --}}
                <form action="{{URL('/delete-order-admin',$item->order_id)}}" method="post">
                    @csrf
                    <button class="btn btn-default" onclick="return confirm('Bạn chắc là muốn hủy đơn hàng')" >
                      <i class="fas fa-trash-alt text-danger"></i>
                    </button>
                </form>
                {{-- end delete order in page admin --}}
                {{-- xem thông tin đơn hàng --}}
                <a href="{{URL('/view-order-details-product',$item->order_id)}}">
                  <button class="btn btn-default">
                        <i class="fas fas fa-eye  text-success"></i>
                  </button> 
                </a>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">
          
          <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm">Hiển thị 6 trong số tổng mặt hàng</small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            {!! $order_customer_product->links() !!}
          </div>
        </div>
      </footer>
    </div>
  </div>
@endsection