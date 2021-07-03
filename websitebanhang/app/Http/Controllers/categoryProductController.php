<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categoryproduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\SliderBanner;
use App\Models\cate_news;

class categoryProductController extends Controller
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
        $this->Authenlogin();
        $data = array();
        $data['categoryproduct'] =  categoryproduct::orderBy('id','ASC')->paginate(12);
        return view('admincp.categoryproduct.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->Authenlogin();
        return view('admincp.categoryproduct.create');
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
        //kiêm tra xac thuc
        $data = $request->validate(
        [
            'category_name' => 'required|unique:tbl_category_product|max:255',
            'category_desc' => 'required|max:255',
            'category_status'=>'required'
        ],
        [
            'category_name.required' =>'Tên danh mục phải có và duy nhât',
            'category_desc.required' =>'bạn quên chưa nhập phần mô tả',
            'category_status.required' =>'Bạn quên chưa chọn phần status'
        ]);
        $danhmuc = new categoryproduct();
        $danhmuc->category_name = $data['category_name'];
        $danhmuc->category_desc = $data['category_desc'];
        $danhmuc->category_status = $data['category_status'];
        $danhmuc->save();
        //return redirect()->back()->with('status','thêm danh mục thành công');
        return redirect('/categoryproduct')->with('status','thêm danh mục thành công');
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
        $data = categoryproduct::find($id);
        return view('admincp.categoryproduct.edit')->with(compact('data'));
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


        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_desc'] = $request->category_desc;
        DB::table('tbl_category_product')->where('id',$id)->update($data);
        return redirect()->back()->with('status','Cập nhật danh mục thành công');
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
       categoryproduct::find($id)->delete();
       return redirect()->back()->with('status','Bạn đã xóa danh mục thành công');
    }

    public function Unactive_category_product($id)
    {
        $this->Authenlogin();
        DB::table('tbl_category_product')->where('id',$id)->update(['category_status'=>1]);
        return redirect()->back()->with('status','Đã hiển thị danh mục thành công');
    }

    public function Active_category_product($id)
    {
        $this->Authenlogin();
        DB::table('tbl_category_product')->where('id',$id)->update(['category_status'=>0]);
        return redirect()->back()->with('status','Đã ẩn danh mục thành công');
    }

    //end function admin Page
    public function Show_category_home($id)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('id','desc')->get();
        $brand_products = DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('id','desc')->get();

        $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.id')->where('tbl_product.category_id',$id)->get();

        // lấy ra tên của mỗi category
        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.id',$id)->limit(1)->get();


        //show slider banner
        $slider = array();
        $slider['show_slider_home'] = SliderBanner::where('slider_status','1')->orderBy('slider_id','DESC')->take(4)->get();

         //danh muc tin tuc
         $show_cate_new = cate_news::where('cate_news_status','1')->orderBy('cate_news_id','DESC')->get();

        return view('admincp.categoryproduct.showcategoryhome',$slider)->with('category',$cate_product)->with('brand_products',$brand_products)->with('category_by_id',$category_by_id)->with('cate_name',$category_name)->with('show_cate_new',$show_cate_new);
    }
}
