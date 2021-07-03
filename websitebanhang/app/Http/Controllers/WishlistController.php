<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\wishlist;
use App\Models\SliderBanner;
use App\Models\cate_news;


class WishlistController extends Controller
{
    public function add_wishlist($product_id,Request $request)
    {
        
        // add wishlist
        $data = array();
        $customer_id = Session::get('customer_id');
       

        // $data = $request->validate([
        //    'product_id' => 'required|unique:tbl_wishlist',
        //    'customer_id' =>'required'
        // ]);
            if ($customer_id) {
               

                $data['product_id'] = $product_id;
                $data['customer_id'] =  $customer_id;

                DB::table('tbl_wishlist')->insert($data);
            } else {
                return redirect()->back();
            }
         
        return redirect()->back();
    }

    public function show_wishlist(){
        $customer_id = Session::get('customer_id');
        
        $category = DB::table('tbl_category_product')->where('category_status','1')->orderBy('id','ASC')->get();
        $brand_products = DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('id','ASC')->get();

        //show slider banner
        $slider = array();
         $slider['show_slider_home'] = SliderBanner::where('slider_status','1')->orderBy('slider_id','DESC')->take(4)->get();

        $show_wishlist = DB::table('tbl_wishlist')->join('tbl_product','tbl_product.product_id','=','tbl_wishlist.product_id')->join('tbl_customer','tbl_customer.customer_id','=','tbl_wishlist.customer_id')->where('tbl_customer.customer_id',$customer_id)->get();

        //danh muc tin tuc
        $show_cate_new = cate_news::where('cate_news_status','1')->orderBy('cate_news_id','DESC')->get();
  
        return view('admincp.product.wishlist',$slider)->with('category', $category)->with('brand_products', $brand_products)->with('show_wishlist',$show_wishlist)->with('show_cate_new',$show_cate_new);
    }
}
