<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\cate_news;
use App\Models\SliderBanner;

class NewsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        $show_post_new = DB::table('tbl_news')->join('tbl_cate_news','tbl_cate_news.cate_news_id','=','tbl_news.cate_new_id')->orderBy('news_id','desc')->paginate(6);

        return view('admincp.news.list_news')->with('show_post_new',$show_post_new);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->Authenlogin();
        $select_cate_new = array();
        $select_cate_new['cate_news_names'] = cate_news::orderBy('cate_news_id', 'DESC')->get();
        return view('admincp.news.add_news',$select_cate_new);
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

        $data = $request->all();

        $post_news = new News();
        $post_news->news_title = $data['news_title'];
        $post_news->cate_new_id = $data['cate_new_id'];
        $post_news->news_desc = $data['news_desc'];
        $post_news->news_content = $data['news_content'];
        $post_news->news_meta_desc = $data['news_meta_desc'];
        $post_news->news_meta_keyword = $data['news_meta_keyword'];
        $post_news->news_status = $data['news_status'];

        $get_image = $request->file('news_image');

        if($get_image)
        {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/post',$new_image);
            $post_news->news_image = $new_image;
            $post_news->save();
            return redirect()->back()->with('status','Bạn đã thêm bài viết thành công');
        }else{
            return redirect()->back()->with('status','Bạn đã thêm bài viết thất bại xẹm lại có bỏ trống không.');
        }

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
    public function edit($news_id)
    {
        $this->Authenlogin();

       
        $select_cate_news = cate_news::orderBy('cate_news_id')->get();

        $get_all_news = News::where('news_id',$news_id)->first();

        return view('admincp.news.edit_news')->with(compact('get_all_news','select_cate_news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $news_id)
    {
    //     $this->Authenlogin();

       $data = array();
        $post_news = DB::table('tbl_news')->where('news_id', $news_id)->first();

        $data['news_title'] = $request->news_title;
        $data['cate_new_id'] = $request->cate_new_id;
        $data['news_desc'] = $request->news_desc;
        $data['news_content'] = $request->news_content;
        $data['news_meta_desc'] = $request->news_meta_desc;
        $data['news_meta_keyword'] = $request->news_meta_keyword;
        $data['news_status'] = $request->news_status;


        $get_image = $request->file('news_image');

        if($get_image)
        {

            // xóa hình ảnh cũ trong thư mục public/uploads/post
            $get_img_old = $post_news->news_image;
            unlink('uploads/post/'.$get_img_old);

            //cập nhật ảnh mới
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/post',$new_image);
            $data['news_image'] = $new_image;
    
        }
         DB::table('tbl_news')->where('news_id', $news_id)->update($data);
        return redirect()->back()->with('status','Bạn đã cập bài viết thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($news_id)
    {
        // tạo điều kiên cho lấy đương dẫn image
         $delete_news = News::where('news_id', $news_id)->first();
         $get_news_img = $delete_news->news_image;
         unlink('uploads/post/'.$get_news_img);
         //xóa trong cơ sở dữ liệu
         News::where('news_id', $news_id)->delete();
        return redirect()->back()->with('status','Bạn đã  xóa bài viết thành công');
    }


    //end function news admin 
    // setting news status 
    public function unactive_news($news_id)
    {
        News::where('news_id', $news_id)->update(['news_status'=>1]);
        return redirect()->back()->with('status','Bạn đã hiện thị bài viết tin tức thành công');
       
    }

    public function active_news($news_id)
    {
        News::where('news_id', $news_id)->update(['news_status'=>0]);
        return redirect()->back()->with('status','Bạn đã ẩn bài viết tin tức thành công');
    }

    // start layout user
    public function show_cate_news($cate_news_id)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('id','desc')->get();

        $brand_products = DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('id','desc')->get();

        $slider = array();
        $slider['show_slider_home'] = SliderBanner::where('slider_status','1')->orderBy('slider_id','DESC')->take(4)->get();

        //danh muc tin tuc
        $show_cate_new = DB::table('tbl_cate_news')->where('cate_news_status','1')->orderBy('cate_news_id','desc')->get();

        $get_name_cate_news = cate_news::where('cate_news_id',$cate_news_id)->take(1)->get();

        //lay bai viet theo danh muc
        $get_news = DB::table('tbl_news')->join('tbl_cate_news','tbl_cate_news.cate_news_id','=','tbl_news.cate_new_id')->where('tbl_cate_news.cate_news_id',$cate_news_id)->where('news_status','1')->orderBy('news_id','desc')->paginate(6);

        return view('admincp.news.show_cate_news',$slider)->with('category',$cate_product)->with('brand_products',$brand_products)->with('show_cate_new',$show_cate_new)->with('get_name_cate_news',$get_name_cate_news)->with('get_news',$get_news);
    }

    // xem nội dung bài Viết
    public function view_news($news_id)
    {
        // danh mục sản phẩm
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('id','desc')->get();

        // thương hiệu sản phẩm
        $brand_products = DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('id','desc')->get();

        // slider banner
        $slider = array();
        $slider['show_slider_home'] = SliderBanner::where('slider_status','1')->orderBy('slider_id','DESC')->take(4)->get();

        //danh muc tin tuc
        $show_cate_new = DB::table('tbl_cate_news')->where('cate_news_status','1')->orderBy('cate_news_id','DESC')->get();

        // lấy nội dung bài viết
        $get_content_news = News::where('news_id',$news_id)->where('news_status',1)->take(1)->get();
        

        

        return view('admincp.news.view_news',$slider)->with('category',$cate_product)->with('brand_products',$brand_products)->with('show_cate_new',$show_cate_new)->with('get_content_news',$get_content_news);




    }

}
