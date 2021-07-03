@extends('admincp.adminlayouts.admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê vấn đề cần liên hệ của khác hàng
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
              <th>Tên khách hàng</th>
              <th>Email</th>
              <th>Số điện thoại</th>
              <th>Vấn đề cần trợ giúp</th>
              <th>Mô tả vấn đề</th>
              <th>Ngày gửi</th>
              <th>Chức năng</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
          @foreach ($contact_admin as $item)
            <tr>
              <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
              <td>{{$item->contact_name}}</td>
              <td>{{$item->contact_email}}</td>
              <td>{{$item->contact_phone}}</td>
              <td>{{$item->contact_title}}</td>
              <td>{{$item->contact_desc}}</td>
              <td><span class="text-ellipsis">{{$item->created_at}}</span></td>
              <td>
                 <form action="{{ url('/delete-contact/'.$item->contact_id) }}"  method="POST">
                    {{-- @method('DELETE') --}}
                      @csrf
                      <button class="btn btn-default" onclick="return confirm('Bạn chắc là muốn xóa')" >
                        <i class="fas fa-trash-alt text-danger"></i>
                      </button>
                </form> 
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">
          
          <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm">Hiển thị 12 trong tổng số </small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            {!! $contact_admin->links() !!}
          </div>
        </div>
      </footer>
    </div>
  </div>
@endsection