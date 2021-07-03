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
          {{-- <select class="input-sm form-control w-sm inline v-middle">
            <option value="0">Bulk action</option>
            <option value="1">Delete selected</option>
            <option value="2">Bulk edit</option>
            <option value="3">Export</option>
          </select>
          <button class="btn btn-sm btn-default">Apply</button>                 --}}
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
              <th>Tiêu để bài viết</th>
              <th>Hình ảnh</th>
              <th>Mô ta bài viết</th>
              <th>Từ khóa bài việt</th>
              <th>Danh mục bài viết</th>
              
              <th>Trạng thái bài viết</th>
              <th>Ngày thêm</th>
              <th>Chức năng</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
          @foreach ($show_post_new as $item)
            <tr>
              <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
              <td>{{$item->news_title}}</td>
              <td><img src="{{asset('uploads/post/'.$item->news_image)}}" width="100" height="100"/></td>
              <td>{!! $item->news_desc !!}</td>
              <td>{{$item->news_meta_keyword}}</td>
              <td>{{$item->cate_news_name}}</td>
              <td>
              {{--start status product --}}
                {{-- 0 là ẩn, 1 la hien --}}
              @if($item->news_status == 0) 
                <a href="{{URL('/unactive-news',$item->news_id)}}">
                    <span class="fa-thumb-styling fas fa-eye-slash text-danger"></span>
                </a>
              @else
                  <a href ="{{URL('/active-news',$item->news_id)}}">
                    <span class="fa-thumb-styling fas fas fa-eye text-success"></span>
                  </a>
              @endif
              {{-- end start status product --}}
              </td>
              <td><span class="text-ellipsis">{{$item->created_at}} </span></td>
              <td>
              {{-- Delete product --}}
                 <form action=" {{route('news.destroy',$item->news_id)}}"  method="POST">
                    @method('DELETE')
                      @csrf
                      <button class="btn btn-default" onclick="return confirm('Bạn chắc là muốn xóa')" >
                        <i class="fas fa-trash-alt text-danger"></i>
                      </button>
                </form> 
                {{-- edit product --}}
                <a href="{{route('news.edit',$item->news_id)}}">
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
            <small class="text-muted inline m-t-sm m-b-sm">Hiển thị 6 trong tổng số mặt hàng</small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            

            {!! $show_post_new->links() !!}
          </div>
        </div>
      </footer>
    </div>
  </div>
@endsection