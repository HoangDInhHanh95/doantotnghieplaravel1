<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\SliderBanner;
use App\Models\cate_news;


class brandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // kiểm tra xem có đang nhập không 
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
        $this->Authenlogin();
        $data = array();
        $data['brand'] =  brand::orderBy('id','ASC')->paginate(12);
        return view('admincp.brand.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->Authenlogin();
        return view('admincp.brand.create');
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
       $data = $request->validate([
           'brand_name'=>'required|unique:tbl_brand_product|max:255',
           'brand_desc' =>'required',
           'brand_status' => 'required',
       ],
       [
           'brand_name.required' =>'Tên thương hiệu phải là duy nhất',
           'brand_desc.required' =>'Bạn quên chưa nhập phân mô tả',
           'brand_status.required' =>'Bạn quên chưa chọn trang thái hiện thị'
       ]);

       $brand = new Brand();
       $brand->brand_name = $data['brand_name'];
       $brand->brand_desc = $data['brand_desc'];
       $brand->brand_status = $data['brand_status'];

        $brand->save();
        return redirect()->back()->with('status','Bạn đã thêm thương hiệu thành công');

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
    public function edit($id)
    {
        $this->Authenlogin();
        $data = brand::find($id);
        return view('admincp.brand.edit')->with(compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->Authenlogin();
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_desc'] = $request->brand_desc;
        DB::table('tbl_brand_product')->where('id',$id)->update($data);
        return redirect()->back()->with('status','Cập nhật thương hiệu thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->Authenlogin();
        brand::find($id)->delete();
        return redirect()->back()->with('status','Bạn đã xóa thương hiệu thành công');
    }

    // cai đat trang thái hiên thi cho thương hiệu
    public function Unactive_brand_product($id)
    {
        $this->Authenlogin();
        DB::table('tbl_brand_product')->where('id',$id)->update(['brand_status'=>1]);
        return redirect()->back()->with('status','Đã hiển thị thương hiệu thành công');
    }

    public function Active_brand_product($id)
    {
        $this->Authenlogin();
        DB::table('tbl_brand_product')->where('id',$id)->update(['brand_status'=>0]);
        return redirect()->back()->with('status','Đã ẩn thương hiệu thành công');
    }

    // end function admin brand Page 
    // function đang lôi đơi sưa an cơm
    public function Show_brand_home($id)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('id','desc')->get();
        $brand_products = DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('id','desc')->get();

        // show san pham theo thuong hieu
        $brand_by_id = DB::table('tbl_product')->join('tbl_brand_product','tbl_product.brand_id','=','tbl_brand_product.id')->where('tbl_product.brand_id',$id)->get();

        // lấy ra tên của mỗi category
        $brand_name = DB::table('tbl_brand_product')->where('tbl_brand_product.id',$id)->limit(1)->get();

        //show slider banner
        $slider = array();
        $slider['show_slider_home'] = SliderBanner::where('slider_status','1')->orderBy('slider_id','DESC')->take(4)->get();

        //danh muc tin tuc
        $show_cate_new = DB::table('tbl_cate_news')->where('cate_news_status','1')->orderBy('cate_news_id','DESC')->get();
        
        return view('admincp.brand.showbrandhome',$slider)->with('category',$cate_product)->with('brand_products',$brand_products)->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name)->with('show_cate_new',$show_cate_new);
    }
}
