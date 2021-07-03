
@extends('admincp.adminlayouts.admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
                <header class="panel-heading">
                    Thêm bài viết tìn tức
                </header>
                <div class="panel-body">
                    <div class="position-center">
                     {{-- status thông báo lỗi --}}
                     @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif 
                     {{--end status thông báo lỗi URL('/updete-news',$get_all_news->news_id) --}}
                        <form action="{{ route('news.update',$get_all_news->news_id)}}" method="POST" enctype="multipart/form-data">
                            @method('PUT') {{--phương thuc gia --}}
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tiêu đề bài viết</label>
                                <input type="text" class="form-control" value="{{$get_all_news->news_title}}" placeholder="Tên danh  mục" name="news_title">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tóm tắt bài viết</label>
                                <textarea style="resize:none" rows="3" class="form-control" id="ckeditor2" placeholder="Mô ta danh mục" name="news_desc" >
                                    {{$get_all_news->news_desc}}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Từ khóa bài viết</label>
                                <textarea style="resize:none" rows="2" class="form-control" id="exampleInputPassword1" placeholder="Mô ta danh mục" name="news_meta_keyword" >
                                    {{$get_all_news->news_meta_keyword}}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả từ khóa</label>
                                <textarea style="resize:none" rows="3" class="form-control" id="exampleInputPassword1" placeholder="Mô ta danh mục" name="news_meta_desc" >
                                    {{$get_all_news->news_meta_desc}}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nội dung bài viết</label>
                                <textarea style="resize:none" rows="5" class="form-control" id="ckeditor3" placeholder="Mô ta danh mục" name="news_content" >
                                    {{ $get_all_news->news_content }}
                                </textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Danh  mục bài viết</label>
                                <select class="form-control input-sm m-bot15" name="cate_new_id" >
                                    @foreach ($select_cate_news as $v_cate_news )
       
                                        <option {{ $get_all_news->cate_new_id == $v_cate_news->cate_news_id ? 'selected' : '' }} value="{{$v_cate_news->cate_news_id}}">{{$v_cate_news->cate_news_name}}</option>
                                      
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh đại diện</label> <br>
                                <img src="{{asset('uploads/post/'.$get_all_news->news_image)}}" alt="" width = "100" height="100"><br><br> 
                                <input type="file" class="form-control" id="exampleInputEmail1"  name="news_image">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Trang thái</label>
                                <select class="form-control input-sm m-bot15" name="news_status" >
                                    @if ($get_all_news->news_status == 0 )
                                        <option selected value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>

                                    @else
                                        
                                    <option value="0">Ẩn</option>
                                    <option selected value="1">Hiển thị</option>
                                    @endif
                                </select>
                            </div>
                            <button type="submit" name="update_news" class="btn btn-info">Thêm mới</button>
                        </form>
                    </div>
                </div>
        </section>
    </div>
</div>
@endsection