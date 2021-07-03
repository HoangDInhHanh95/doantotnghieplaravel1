<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\gallery;
use App\Models\SliderBanner;
use App\Models\cate_news;
use App\Models\rating;


class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // kiểm tra xem có đang nhập vao Chưa
    public function Authenlogin(){
        $admin_id =  Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/admincp/quantri');
        }else{
            return Redirect::to('/logout')->send();
        }
    }
    public function index()
    {
        // $data = array();
        // $data['products'] =  product::orderBy('product_id','desc')->get();
        // return view('admincp.product.index',$data);
        $this->Authenlogin();

        $all_product = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.id','=','tbl_product.category_id')->join('tbl_brand_product','tbl_brand_product.id','=','tbl_product.brand_id')->paginate(6);
        $manager_product = view('admincp.product.index')->with('all_product', $all_product); // => all_product moi la ten hien thi
        return view('admincp.adminlayouts.admin_layout')->with('admincp.product.index', $manager_product);

    }


    // show tat ca san pham
    public function show_all_product()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('id','ASC')->get();
        $brand_products = DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('id','ASC')->get();
        // $all_product = DB::table('tbl_product')->where('product_status','1')->orderBy('product_id','desc')->paginate(12); ->with('all_product',$all_product)
        $data = array();
        $data['all_product'] = product::where('product_status','1')->orderBy('product_id','desc')->paginate(12);
        
         //show slider banner
         $slider = array();
         $slider['show_slider_home'] = SliderBanner::where('slider_status','1')->orderBy('slider_id','DESC')->take(4)->get();

         //danh muc tin tuc
         $show_cate_new = cate_news::where('cate_news_status','1')->orderBy('cate_news_id','DESC')->get();


        return view('admincp.product.show_all_product',$data,$slider)->with('category',$cate_product)->with('brand_products',$brand_products)->with('show_cate_new',$show_cate_new);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->Authenlogin();
        $cate_product = DB::table('tbl_category_product')->orderBy('id','ASC')->get();
        $brand_products = DB::table('tbl_brand_product')->orderBy('id','ASC')->get();
        return view('admincp.product.create')->with('cate_product', $cate_product)->with('brand_products', $brand_products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->Authenlogin();
        $data = array();
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_price'] = $request->product_price;
        $data['product_size'] = $request->product_size;
        $data['product_content'] = $request->product_content;
        $data['product_image'] = $request->product_image;
        $data['product_color'] = $request->product_color;
        $data['product_status'] = $request->product_status;

        $get_image =$request->file('product_image');
        if($get_image)
        {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            //getClientOriginalExtension()=> lấy phân đuôi (png,jpg,jpeg) mở rông của image
            $new_imege = $name_image.rand(0,9999999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/product',$new_imege);
            $data['product_image'] = $new_imege; //=> product_image trong database
            DB::table('tbl_product')->insert($data);
            return redirect()->back()->with('status','Bạn đã thêm sản phẩm thành công');
        }
        $data['product_image'] = '';
        DB::table('tbl_product')->insert($data);
        return redirect()->back()->with('status','Bạn đã thêm sản phẩm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($product_id)
    {
        $this->Authenlogin();
        $cate_product = DB::table('tbl_category_product')->orderBy('id','ASC')->get();
        $brand_products = DB::table('tbl_brand_product')->orderBy('id','ASC')->get();

        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();

        $manager_product = view('admincp.product.edit')->with('edit_product',$edit_product)->with('cate_product',$cate_product)->with('brand_products',$brand_products);

        return view('admincp.adminlayouts.admin_layout')->with('admincp.product.index', $manager_product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_id)
    {
        $this->Authenlogin();
        $data = array();
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_price'] = $request->product_price;
        $data['product_size'] = $request->product_size;
        $data['product_content'] = $request->product_content;
        $data['product_color'] = $request->product_color;
        $data['product_status'] = $request->product_status;

        $get_image = $request->file('product_image');

        if($get_image)
        {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            //getClientOriginalExtension()=> lấy phân đuôi (png,jpg,jpeg) mở rông của image
            $new_imege = $name_image.rand(0,9999999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/product',$new_imege);
            $data['product_image'] = $new_imege; //=> product_image trong database
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
           return Redirect::to('/product')->with('status','Bạn đã cập nhật thành công');
           
        }
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        return Redirect::to('/product')->with('status','Bạn đã cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id)
    {
        $this->Authenlogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        return redirect()->back()->with('status','Bạn đã xóa sản phẩm thành công');
    }

    // cai dat trang thai cho san pham 
    public function Unactive_product($product_id)
    {
        $this->Authenlogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        return redirect()->back()->with('status','Đã hiển thị danh mục thành công');
    }

    public function Active_product($product_id)
    {
        $this->Authenlogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        return redirect()->back()->with('status','Đã ân hiển thị danh mục thành công');
    }

    // end function product
    // chi tiết sản phẩm
    public function details_product($product_id)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('id','desc')->get();
        $brand_products = DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('id','desc')->get();

        $details_product = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.id','=','tbl_product.category_id')->join('tbl_brand_product','tbl_brand_product.id','=','tbl_product.brand_id')->where('product_id',$product_id)->get();
      
        //thiết lập sản phẩm liên quan
        foreach($details_product as $key => $value){
            $cate_id = $value->category_id;
            $product_id = $value->product_id;
        }

        // start gallery show
        $gallery_show = gallery::where('product_id',$product_id )->get();

        // end gallery show
        $related_product = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.id','=','tbl_product.category_id')->join('tbl_brand_product','tbl_brand_product.id','=','tbl_product.brand_id')->where('tbl_category_product.id',$cate_id)->limit(3)->whereNotIn('tbl_product.product_id',[$product_id])->get();
        // chú thích hàm whereNotIn() lây tất ca san phâm ngoài trừ cái san phẩm có id là id truyền vào. Thông số thứ 2 lả 1 array

        ///////// 
        $related_product_item = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.id','=','tbl_product.category_id')->join('tbl_brand_product','tbl_brand_product.id','=','tbl_product.brand_id')->where('tbl_category_product.id',$cate_id)->offset(3)->limit(3)->whereNotIn('tbl_product.product_id',[$product_id])->get();

        //show slider banner
        $slider = array();
        $slider['show_slider_home'] = SliderBanner::where('slider_status','1')->orderBy('slider_id','DESC')->take(4)->get();

        //danh muc tin tuc
        $show_cate_new = cate_news::where('cate_news_status','1')->orderBy('cate_news_id','DESC')->get();


        //lấy số sao trung bình của tbl_rating khi người dung đánh vào
        $rating = rating::where('product_id',$product_id)->avg('rating');
        $rating = round($rating);
        // echo $rating;
        
        return view('admincp.sanpham.show_details',$slider)->with('category',$cate_product)->with('brand_products',$brand_products)->with('details_product',$details_product)->with('related_product',$related_product)->with('related_product_item',$related_product_item)->with('gallery_show',$gallery_show)->with('show_cate_new',$show_cate_new)->with('rating',$rating);
    }

    // function đánh giá sao cho sản phẩm => đang bị lỗi
    public function insert_rating(Request $request)
    {
        $data = $request->all();
        dd($data);

        // $rating = new rating();
        // $rating->product_id = $data['product_id'];
        // $rating->rating = $data['index'];
        // $rating->save();
        // echo 'done';
    }
}
