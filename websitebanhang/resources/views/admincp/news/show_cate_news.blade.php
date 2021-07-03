@extends('welcome')
@section('content')
<style type="text/css">
    .features_items div.product-image-wrapper-new{
        /* border: 1px solid #F7F7F5; */
        overflow: hidden;
        margin-bottom: 3%;
        
    }

    .features_items div.product-image-wrapper-new .productinfo .col-sm-4 img.img_news{
        width: 100%;
        height: 200px;
        padding-top: 7%;
    }

</style> 
<div class="features_items">
    <!--features_items-->
    
    @foreach ($get_name_cate_news as $key => $category_new_name)
        <h2 class="title text-center">Tin tức {{  $category_new_name->cate_news_name }}</h2> 
    @endforeach
    {{--show news  --}}
   @foreach ($get_news as $key => $value_news)
   <div class="product-image-wrapper-new">
        <div class="single-products">
            <div class="productinfo">
                <div class="col-sm-4">
                    <img src="{{asset('uploads/post/'.$value_news->news_image) }}" s  class="img_news"  >
                   
                </div>
                <div class="col-sm-8">
                    <h3>{{ $value_news->news_title }}</h3>
                    <p>
                        {!! $value_news->news_desc !!}
                    </p>
                    <div class="text-right">
                        <a class="btn btn-default" href="{{ url('/view-news/'.$value_news->news_id)}}"> Xem thêm </a>
                    </div>
                </div>
            </div>
        </div>
    </div> 
   @endforeach
</div>
<div class="setting_pagination">
    {!! $get_news->links() !!}
</div>
@endsection