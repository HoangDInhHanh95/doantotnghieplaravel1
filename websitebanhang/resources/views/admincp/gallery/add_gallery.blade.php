
@extends('admincp.adminlayouts.admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
                <header class="panel-heading">
                    Thêm thư viên hình ảnh
                </header>
                {{-- status thông báo lỗi --}}
                  @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                   @endif 
               {{--end status thông báo lỗi --}}
                <form action="{{URL('/insert-gallery-image/'.$pro_id)}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="col-md-3" again="right">

                    </div>
                    <div class="col-md-6">
                      <input type="file" value="23"  class="form-control " id="file_gallery"  name="file[]" accept="image/*" multiple>
                      <span id="error_gallery"></span>
                    </div>
                    <div class="col-md-3">
                        <input type="submit" name="uploads_gallery" value="Thêm ảnh" class="btn btn-success">
                    </div>
                  </div>
                </form>
                <div class="panel-body">
                    <input type="hidden" value="{{$pro_id}}" name="pro_id" class="pro_id">
                  <form>
                    @csrf
                    <div id="gallery_load">
                            
                    </div>
                  </form>
                </div>
        </section>
    </div>
</div>

<script type="text/javascript">
 // thông báo lỗi khi thêm thư viện ảnh
        

// code điều kiền khi thêm ảnh




</script>
@endsection