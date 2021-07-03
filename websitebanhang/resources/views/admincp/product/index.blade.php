@extends('admincp.adminlayouts.admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê sản phẩm
      </div>
      <div class="row w3-res-tb">
      {{-- status thông báo lỗi --}}
        @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        @endif 
      {{--end status thông báo lỗi --}}
        <div class="col-sm-5 m-b-xs">
          <select class="input-sm form-control w-sm inline v-middle">
            <option value="0">Bulk action</option>
            <option value="1">Delete selected</option>
            <option value="2">Bulk edit</option>
            <option value="3">Export</option>
          </select>
          <button class="btn btn-sm btn-default">Apply</button>                
        </div>
        <div class="col-sm-4">
        </div>
        <form action="{{url('/search-product-admin')}}" method="post">
          @csrf
          <div class="col-sm-3">
            <div class="input-group">
              <input type="text" class="input-sm form-control" name="search_product_page_admin" placeholder="Search">
              <span class="input-group-btn">
                <button class="btn btn-sm btn-default" type="submit">Go!</button>
              </span>
            </div>
          </div>
        </form>
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
              <th>Tên sản phẩm</th>
              <th>Danh mục sản phẩm</th>
              <th>Thương hiệu sản phẩm</th>
              <th>Kích thước sản phẩm</th>
              <th>Giá sản phẩm</th>
              <th>Hình ảnh</th>
              <th>Thư viện ảnh</th>
              <th>Hiển thị</th>
              <th>Ngày thêm</th>
              <th>Chức năng</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
          @foreach ($all_product as $item)
            <tr>
              <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
              <td>{{$item->product_name}}</td>
              <td>{{$item->category_name}}</td>
              <td>{{$item->brand_name}}</td>
              <td>{{$item->product_size}}</td>
              <td>{{ number_format($item->product_price)}} vnđ</td>
              <td><img src="{{URL('uploads/product/'.$item->product_image)}}" width="100" height="100"/></td>
              <td>
                <a href="{{URL('/add-gallery/'.$item->product_id)}}">
                  Thêm thư viện ảnh
                </a>
              </td>
              <td>
              {{--start status product --}}
                {{-- 0 là ẩn, 1 la hien --}}
              @if($item->product_status==0) 
                <a href="{{URL('/unactive-product',$item->product_id)}}">
                    <span class="fa-thumb-styling fas fa-eye-slash text-danger"></span>
                </a>
              @else
                  <a href ="{{URL('/active-product',$item->product_id)}}">
                    <span class="fa-thumb-styling fas fas fa-eye text-success"></span>
                  </a>
              @endif
              {{-- end start status product --}}
              </td>
              <td><span class="text-ellipsis">{{$item->created_at}} </span></td>
              <td>
              {{-- Delete product --}}
                 <form action=" {{route('product.destroy',$item->product_id)}}"  method="POST">
                    @method('DELETE')
                      @csrf
                      <button class="btn btn-default" onclick="return confirm('Bạn chắc là muốn xóa')" >
                        <i class="fas fa-trash-alt text-danger"></i>
                      </button>
                </form> 
                {{-- edit product --}}
                <a href="{{route('product.edit',$item->product_id)}}">
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
            <small class="text-muted inline m-t-sm m-b-sm">Hiển thị 12 trong tổng số mặt hàng</small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            

            {!! $all_product->links() !!}
          </div>
        </div>
      </footer>
    </div>
  </div>
@endsection