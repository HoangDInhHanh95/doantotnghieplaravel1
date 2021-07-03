@extends('admincp.adminlayouts.admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê danh mục sản phẩm
      </div>
      <div class="row w3-res-tb">
      {{-- status thông báo lỗi --}}
        @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        @endif 
      {{--end status thông báo lỗi --}}
        {{-- <div class="col-sm-5 m-b-xs">
          <select class="input-sm form-control w-sm inline v-middle">
            <option value="0">Bulk action</option>
            <option value="1">Delete selected</option>
            <option value="2">Bulk edit</option>
            <option value="3">Export</option>
          </select>
          <button class="btn btn-sm btn-default">Apply</button>                
        </div> --}}
        {{-- <div class="col-sm-4">
        </div>
        <div class="col-sm-3">
          <div class="input-group">
            <input type="text" class="input-sm form-control" placeholder="Search">
            <span class="input-group-btn">
              <button class="btn btn-sm btn-default" type="button">Go!</button>
            </span>
          </div>
        </div> --}}
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
              <th>Tên danh muc</th>
              <th>Hiển thị</th>
              <th>Ngày thêm</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
          @foreach ($categoryproduct as $item)
            <tr>
              <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
              <td>{{$item->category_name}}</td>
              <td>
              {{-- hiển thị trang thái của category --}}
              @if($item->category_status==0)
                <a href="{{URL('/unactive-category-product',$item->id)}}">
                    <span class="fa-thumb-styling fas fa-eye-slash text-danger"></span>
                </a>
              @else
                  <a href ="{{URL('/active-category-product',$item->id)}}">
                    <span class="fa-thumb-styling fas fas fa-eye text-success"></span>
                  </a>
              @endif
              </td>
              <td><span class="text-ellipsis">{{$item->created_at}}</span></td>
              <td>
                 <form action=" {{route('categoryproduct.destroy',$item->id)}}"  method="POST">
                    @method('DELETE')
                      @csrf
                      <button class="btn btn-default" onclick="return confirm('Bạn chắc là muốn xóa')" >
                        <i class="fas fa-trash-alt text-danger"></i>
                      </button>
                </form> 
                <a href="{{route('categoryproduct.edit',$item->id)}}">
                  <button class="btn btn-default">
                    <i class="fas fa-edit text-success"></i>
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
            <small class="text-muted inline m-t-sm m-b-sm">Hiển thị 12 trong tổng số  mặt hàng</small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            {!! $categoryproduct->links() !!}
          </div>
        </div>
      </footer>
    </div>
  </div>
@endsection