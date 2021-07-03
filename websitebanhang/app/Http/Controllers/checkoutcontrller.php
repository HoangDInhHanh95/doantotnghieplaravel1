<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
use App\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Models\customer;
use App\Models\order;
use App\Models\shipping;
use App\Models\order_details;
use App\Models\payment;
use App\Models\SliderBanner;
use App\Models\cate_news;

class checkoutcontrller extends Controller
{
    // danh đang nhập cho admin
    public function Authenlogin(){
        $admin_id =  Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/admincp/quantri');
        }else{
            return Redirect::to('/logout')->send();
        }
    }
    // customer => khach hang
    public function login_checkout()
    {

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('id','ASC')->get();
        $brand_products = DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('id','ASC')->get();

         //show slider banner
         $slider = array();
         $slider['show_slider_home'] = SliderBanner::where('slider_status','1')->orderBy('slider_id','DESC')->take(4)->get();

          //danh muc tin tuc
          $show_cate_new = cate_news::where('cate_news_status','1')->orderBy('cate_news_id','DESC')->get();

        return view('admincp.logincustomer.login_checkout',$slider)->with('category',$cate_product)->with('brand_products',$brand_products)->with('show_cate_new',$show_cate_new);

    }

    public function add_customer(Request $request)
    {
       $data = array();
       $data['customer_name'] = $request->customer_name;
       $data['customer_email'] = $request->customer_email;
       $data['customer_password'] = md5($request->customer_password);
       $data['customer_address'] = $request->customer_address;
       $data['customer_phone'] = $request->customer_phone;

        $customer_id = DB::table('tbl_customer')->insertGetId($data);
        // insertGetId => lấy luôn dữ liệu customer_id vừa insert vào
        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$request->customer_name);
        return Redirect::to('/checkout');
    }

    public function checkout_customer()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('id','ASC')->get();
        $brand_products = DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('id','ASC')->get();

        //show slider banner
        $slider = array();
        $slider['show_slider_home'] = SliderBanner::where('slider_status','1')->orderBy('slider_id','DESC')->take(4)->get();

        $show_cate_new = cate_news::where('cate_news_status','1')->orderBy('cate_news_id','DESC')->get();


        return view('admincp.logincustomer.show_checkout',$slider)->with('category',$cate_product)->with('brand_products',$brand_products)->with('show_cate_new',$show_cate_new);
    }

    // lưu thông tin đặt hàng
    public function save_cart_checkout(Request $request)
    {
        $data = array();
        
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_size'] = $request->shipping_size;
        $data['shipping_color'] = $request->shipping_color;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_note'] = $request->shipping_note;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_phone'] = $request->shipping_phone;
         // insertGetId => lấy luôn dữ liệu customer_id vừa insert vào
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        // session lưu gia trị id của table tbl_shipping
        Session::put('shipping_id',$shipping_id);
        return Redirect::to('/payment');
    }

    //chọn hinh thuc dat hang
    public function payment()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('id','ASC')->get();
        $brand_products = DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('id','ASC')->get();

         //show slider banner
         $slider = array();
         $slider['show_slider_home'] = SliderBanner::where('slider_status','1')->orderBy('slider_id','DESC')->take(4)->get();

          //danh muc tin tuc
          $show_cate_new = cate_news::where('cate_news_status','1')->orderBy('cate_news_id','DESC')->get();

        return view('admincp.logincustomer.payment',$slider)->with('category',$cate_product)->with('brand_products',$brand_products)->with('show_cate_new',$show_cate_new);
    }

    //xu lý hình thức đạt hàng
    public function payment_method_order(Request $request)
    {   //insert payment => insert gia tri phuong thuc thanh toan
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = '1'; // 1=> đang chở xử lý => duyêtj đơn hàng.
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        // lay gia tri id vua truy vao
        // Session::put('shipping_id', $shipping_id);
        // them du lieu vao bang order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] =$payment_id; 
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = '1'; // => dang cho phe duyet
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        // them vao table chi tiet san pham => order-details
        $content = Cart::content();//=> bien content => trong cart
        foreach ($content as $va_content)
        {
            $order_details_data = array();
            $order_details_data['order_id'] = $order_id;
            $order_details_data['payment_id'] = $payment_id;
            $order_details_data['product_id'] = $va_content->id;
            $order_details_data['shipping_id'] = Session::get('shipping_id');
            $order_details_data['customer_id'] = Session::get('customer_id');
            $order_details_data['product_name'] = $va_content->name;
            $order_details_data['product_price'] =  Cart::total();
            $order_details_data['product_sales_quantity'] = $va_content->qty;
            DB::table('tbl_order_details')->insert($order_details_data);
        }
        // cach phuong thuc thanh toan
        if($data['payment_method'] == 2)
        {
            Cart::destroy();
            $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('id','ASC')->get();
            $brand_products = DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('id','ASC')->get();

             //show slider banner
            $slider = array();
            $slider['show_slider_home'] = SliderBanner::where('slider_status','1')->orderBy('slider_id','DESC')->take(4)->get();

            //danh muc tin tuc
            $show_cate_new = cate_news::where('cate_news_status','1')->orderBy('cate_news_id','DESC')->get();

            return view('admincp.logincustomer.hand_cash',$slider)->with('category',$cate_product)->with('brand_products',$brand_products)->with('show_cate_new',$show_cate_new);
        }elseif($data['payment_method'] == 1){
            echo 'Thanh toán bằng thẻ ATM';
        }else{
            echo 'thanh toán qua MoMo';
        }

    }

    // hàm đang xuất
    public function logout_checkout()
    {
        Session::flush();
        return Redirect('/login-checkout');
    }

    public function login_account_customer(Request $request)
    {
        $email_account = $request->email_account;
        $password_account = md5($request->password_account);
        
        $result = customer::where('customer_email',$email_account)->where('customer_password',$password_account)->first();
        // $result = DB::table('tbl_customer')->where('customer_email',$email_account)->where('customer_password',$password_account)->first();
        if($result){
            $customer_id = $result->customer_id; 
            Session::put('customer_id',$customer_id);
            Session::put('customer_name',$result->customer_name);
            return Redirect::to('/checkout');
        }else{
            Session::put('message','Tài khoản hoặc mật khẩu không đúng. Vui lòng kiểm tra lại');

            $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('id','ASC')->get();
            $brand_products = DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('id','ASC')->get();

            //show slider banner
            $slider = array();
            $slider['show_slider_home'] = SliderBanner::where('slider_status','1')->orderBy('slider_id','DESC')->take(4)->get();

            //danh muc tin tuc
            $show_cate_new = cate_news::where('cate_news_status','1')->orderBy('cate_news_id','DESC')->get();


            return view('admincp.logincustomer.login_checkout',$slider)->with('category',$cate_product)->with('brand_products',$brand_products)->with('show_cate_new',$show_cate_new);
        }      
    }

    ////////////////////////////////////////////////////////////////
    // hàm quản ly đơn hàng trong admin
    public function manager_order_products()
    {
        $this->Authenlogin();

        $order_customer_product = DB::table('tbl_order')->join('tbl_customer','tbl_customer.customer_id','=','tbl_order.customer_id')->join('tbl_payment','tbl_payment.payment_id','=','tbl_order.payment_id')->join('tbl_shipping','tbl_shipping.shipping_id','=','tbl_order.shipping_id')->paginate(6);

        return view('admincp.sanpham.manager_order')->with('order_customer_product',$order_customer_product);
    }

    /////////////// ////////////
    // phê duyệt đơn hàng
    public function active_order($order_id)
    {
        $this->Authenlogin();
        DB::table('tbl_order')->where('order_id',$order_id)->update(['order_status'=>0]);
        return redirect()->back()->with('status','Đã phê duyệt đơn hàng thành công');
    }

    ////////////////// 
    // không phê duyệt đơn hàng thanh công
    public function unactive_order($order_id)
    {
        $this->Authenlogin();
        DB::table('tbl_order')->where('order_id',$order_id)->update(['order_status'=>1]);
        return redirect()->back()->with('status','Đã hủy đơn hàng hàng thành công');
    }

    ////////////////////////////////
    // xem chi tiết đơn hàng => order details product
    public function view_order_details_product($orderId)
    {
        $this->Authenlogin();

        $order_details_product =  DB::table('tbl_order_details')->join('tbl_order','tbl_order.order_id','=','tbl_order_details.order_id')->join('tbl_shipping','tbl_shipping.shipping_id','=','tbl_order_details.shipping_id')->join('tbl_product','tbl_product.product_id','=','tbl_order_details.product_id')->join('tbl_customer','tbl_customer.customer_id','=','tbl_order_details.customer_id')->join('tbl_payment','tbl_payment.payment_id','=','tbl_order_details.payment_id')->where('tbl_order.order_id',$orderId)->first();  
        // echo '<pre>';
        // print_r($order_details_product);
        // echo '</pre>';
        return view('admincp.sanpham.view_order_details')->with('order_details_product',$order_details_product);
    }

    // xem đơn hàng dành cho khach hàng mua hàng
    public function customer_order_details()
    {
        $get_customer_id = Session::get('customer_id');

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('id','ASC')->get();
        $brand_products = DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('id','ASC')->get();

        $customer_order_details = DB::table('tbl_order_details')->join('tbl_order','tbl_order.order_id','=','tbl_order_details.order_id')->join('tbl_shipping','tbl_shipping.shipping_id','=','tbl_order_details.shipping_id')->join('tbl_product','tbl_product.product_id','=','tbl_order_details.product_id')->join('tbl_customer','tbl_customer.customer_id','=','tbl_order_details.customer_id')->join('tbl_payment','tbl_payment.payment_id','=','tbl_order_details.payment_id')->where('tbl_order_details.customer_id',$get_customer_id)->paginate(6);


        //show slider banner
        $slider = array();
        $slider['show_slider_home'] = SliderBanner::where('slider_status','1')->orderBy('slider_id','DESC')->take(4)->get();

        //danh muc tin tuc
        $show_cate_new = cate_news::where('cate_news_status','1')->orderBy('cate_news_id','DESC')->get();

        return view('admincp.sanpham.customer_order_details',$slider)->with('category',$cate_product)->with('brand_products',$brand_products)->with('customer_order_details',$customer_order_details)->with('show_cate_new',$show_cate_new);

    }


    // method hủy đơn hàng của khách hàng 
    public function delete_order_details($order_details_id)
    {
        $result = order_details::where('order_details_id', $order_details_id)->first();
        if($result)
        {
            $shipping_id = $result->shipping_id;
            $order_id = $result->order_id;
            $payment_id = $result->payment_id;
            
            shipping::where('shipping_id', $shipping_id)->delete();
            payment::where('payment_id', $payment_id)->delete();
            order::where('order_id', $order_id)->delete() ;
            order_details::where('order_details_id', $order_details_id)->delete();
            return redirect()->back();
        }else{

            $get_customer_id = Session::get('customer_id');

            $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('id','ASC')->get();
            $brand_products = DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('id','ASC')->get();

            $customer_order_details = DB::table('tbl_order_details')->join('tbl_order','tbl_order.order_id','=','tbl_order_details.order_id')->join('tbl_shipping','tbl_shipping.shipping_id','=','tbl_order_details.shipping_id')->join('tbl_product','tbl_product.product_id','=','tbl_order_details.product_id')->join('tbl_customer','tbl_customer.customer_id','=','tbl_order_details.customer_id')->where('tbl_order_details.customer_id',$get_customer_id)->paginate(6);

             //show slider banner
            $slider = array();
            $slider['show_slider_home'] = SliderBanner::where('slider_status','1')->orderBy('slider_id','DESC')->take(4)->get();

             //danh muc tin tuc
            $show_cate_new = cate_news::where('cate_news_status','1')->orderBy('cate_news_id','DESC')->get();

             return view('admincp.sanpham.customer_order_details', $slider)->with('category',$cate_product)->with('brand_products',$brand_products)->with('customer_order_details',$customer_order_details)->with('show_cate_new',$show_cate_new);
        }

    }

    // methde admin sử dụng để xóa đơn đặt hàng
    public function delete_order_admin($order_id)
    {
        $this->Authenlogin();

           
        $result = order_details::where('order_id',$order_id )->first();

        if($result){
            $shipping_id = $result->shipping_id;
            $order_details_id = $result->order_details_id;
            $payment_id = $result->payment_id;

            shipping::where('shipping_id', $shipping_id)->delete();
            payment::where('payment_id', $payment_id)->delete();
            order::where('order_id', $order_id)->delete() ;
            order_details::where('order_details_id', $order_details_id)->delete();
            return redirect()->back();
        }
        return redirect()->back();
    }

    

}
