<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\product;
use App\Models\cate_news;
use App\Models\SliderBanner;

class SearchController extends Controller
{
    // kiểm tra đang nhập => nêu đăng nhập mới cho vào
    public function Authenlogin(){
        $admin_id =  Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/admincp/quantri');
        }else{
            return Redirect::to('/logout')->send();
        }
    }

    // tim kiếm sản phẩm trong trang admin
    public function search_product_page_admin(Request $request)
    {   
        
        $this->Authenlogin();

        $get_name_product_admin = $request->search_product_page_admin;
        $result_search_product_page_admin = product::where('product_name','like','%'.$get_name_product_admin.'%')->get();

        return view('admincp.product.search_product_admin')->with('result_search_product_page_admin',$result_search_product_page_admin);
    }


    // hàm tìm kiếm sản phẩm theo tên trong layout trang chủ
   public function search(Request $request)
   {
      $search_prod = $request->search_produ;
      
      $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('id','ASC')->get();
      $brand_products = DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('id','ASC')->get();
      //tim kiem theo ten
      $search_product = DB::table('tbl_product')->where('product_status','1')->where('product_name','like','%'.$search_prod.'%')->get();

     //danh muc tin tuc
     $show_cate_new = cate_news::where('cate_news_status','1')->orderBy('cate_news_id','DESC')->get();

     //show slider banner
     $slider = array();
     $slider['show_slider_home'] = SliderBanner::where('slider_status','1')->orderBy('slider_id','DESC')->take(4)->get();

     return view('admincp.product.search_product',$slider)->with('category',$cate_product)->with('brand_products',$brand_products)->with('search_product',$search_product)->with('show_cate_new',$show_cate_new);
   }







}
