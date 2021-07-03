@extends('welcome')
@section('content')
<style type="text/css">
    

</style> 
<div class="features_items">
    <!--features_items-->
    
     @foreach ($get_content_news as $key => $show_content_news)
        <h2 class="title text-center">{{  $show_content_news->news_title }}</h2> 
    @endforeach
    
   @foreach ($get_content_news as $key => $view_value_news)
   <div class="product-image-wrapper-new">
        <div class="single-products">
            <div class="productinfo">
                {!! $view_value_news->news_content   !!}
            </div>
        </div>
    </div> 
   @endforeach
</div>

@endsection