<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
use App\Coupon;
use Illuminate\Http\Request;
use App\Models\SliderBanner;
use App\Models\cate_news;

class cartController extends Controller
{
    public function save_cart(Request $request)
    {
        $productid = $request->productid_hidden;
        $quantity = $request->qty;

        $product_info = DB::table('tbl_product')->where('product_id',$productid)->first();

        // Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        // setting composer shopping cart
        $data = array();
        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = $product_info->product_price;
        $data['options']['image'] = $product_info->product_image;
        Cart::add($data);  
        // Cart::destroy();
        return Redirect::to('/Show-cart');
    }

    public function Show_cart()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('id','desc')->get();
        $brand_products = DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('id','desc')->get();

        //show slider banner
        $slider = array();
         $slider['show_slider_home'] = SliderBanner::where('slider_status','1')->orderBy('slider_id','DESC')->take(4)->get();

         //danh muc tin tuc
         $show_cate_new = cate_news::where('cate_news_status','1')->orderBy('cate_news_id','DESC')->get();
        
        return view('admincp.cart.show_cart',$slider)->with('category',$cate_product)->with('brand_products',$brand_products)->with('show_cate_new',$show_cate_new);
    }

    public function delete_to_cart($rowId)
    {
        Cart::update($rowId,0);
        return Redirect::to('/Show-cart');
    }


    public function update_cart_qty(Request $request)
    {
        $rowId = $request->rowId_cart;
        $quantity_cart = $request->quantity;
        Cart::update($rowId,$quantity_cart);
        return Redirect::to('/Show-cart');
    }
    
}
