<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\SliderBanner;
use App\Models\cate_news;

class trangchuController extends Controller
{
   public function index()
   {
    $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('id','ASC')->get();
    $brand_products = DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('id','ASC')->get();

    $all_product = DB::table('tbl_product')->where('product_status','1')->orderBy('product_id','desc')->limit(6)->get();

      // hiển thị tab menu product
      //hiên thị ao vest nam
      $ao_vest = DB::table('tbl_product')->where('category_id','1')->orderBy('product_id','desc')->limit(4)->get();

      //hien thi ao so mi
      $ao_so_mi_nam = DB::table('tbl_product')->where('category_id','2')->orderBy('product_id','desc')->limit(4)->get();

      // hien thi đầm nữ 
      $dam_nu = DB::table('tbl_product')->where('category_id','4')->orderBy('product_id','desc')->limit(4)->get();

      //quan nam
      $quan_nam = DB::table('tbl_product')->where('category_id','5')->orderBy('product_id','desc')->limit(4)->get();

      // đồ bọ thể thao

      $do_the_thao = DB::table('tbl_product')->where('category_id','6')->orderBy('product_id','desc')->limit(4)->get();

      //hien thi san pham dươi dang slider bên trang Chủ chua link dên trang nào
      $slider_show_product = DB::table('tbl_product')->where('product_status','1')->orderBy('product_id','desc')->limit(3)->get();

      // slider đang sau 
      $slider_show_product_item = DB::table('tbl_product')->where('product_status','1')->orderBy('product_id','desc')->offset(3)->limit(3)->get();

      // show slider
      $slider = array();
      $slider['show_slider_home'] = SliderBanner::where('slider_status','1')->orderBy('slider_id','DESC')->take(4)->get();


      // show category new in page hone
      $show_cate_new = cate_news::where('cate_news_status','1')->orderBy('cate_news_id','DESC')->get();




       return view('pages.home',$slider)->with('category',$cate_product)->with('brand_products',$brand_products)->with('all_product',$all_product)->with('ao_vest',$ao_vest)->with('ao_so_mi_nam',$ao_so_mi_nam)->with('dam_nu',$dam_nu)->with('quan_nam',$quan_nam)->with('do_the_thao',$do_the_thao)->with('slider_show_product',$slider_show_product)->with('slider_show_product_item',$slider_show_product_item)->with('show_cate_new',$show_cate_new); //=> hiển thị sản phẩm trang chính
   } 


   
}
