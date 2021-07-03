@extends('admincp.adminlayouts.admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê thương hiệu sản phẩm
      </div>
      <div class="row w3-res-tb">
      {{-- status thông báo lỗi --}}
        @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        @endif 
      </div>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
            <th></th>
              {{-- <th style="width:20px;">
                <label class="i-checks m-b-none">
                  <input type="checkbox"><i></i>
                </label>
              </th> --}}
              <th>Tên thương hiệu</th>
              <th>Hiển thị</th>
              <th>Ngày thêm</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
          @foreach ($brand as $item)
            <tr>
              <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
              <td>{{$item->brand_name}}</td>
              <td>
              {{-- hiển thị trang thái của category --}}
              @if($item->brand_status==0)
                <a href="{{URL('/unactive-brand-product',$item->id)}}">
                    <span class="fa-thumb-styling fas fa-eye-slash text-danger"></span>
                </a>
              @else
                  <a href ="{{URL('/active-brand-product',$item->id)}}">
                    <span class="fa-thumb-styling fas fas fa-eye text-success"></span>
                  </a>
              @endif
              </td>
              <td><span class="text-ellipsis">{{$item->created_at}}</span></td>
              <td>
                 <form action=" {{route('brand.destroy',$item->id)}}"  method="POST">
                    @method('DELETE')
                      @csrf
                      <button class="btn btn-default" onclick="return confirm('Bạn chắc là muốn xóa')" >
                        <i class="fas fa-trash-alt text-danger"></i>
                      </button>
                </form> 
                {{-- sưa thương hiệu --}}
                <a href="{{route('brand.edit',$item->id)}}">
                  <button class="btn btn-default">
                    <i class="fas fa-pencil-alt  text-success"></i>
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
            <small class="text-muted inline m-t-sm m-b-sm">Hiển thị 12 trong tổng số 50 mặt hàng</small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            {!! $brand->links() !!}
          </div>
        </div>
      </footer>
    </div>
  </div>
@endsection