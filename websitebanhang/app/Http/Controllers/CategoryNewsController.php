<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\cate_news;

class CategoryNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $data['cate_new'] = cate_news::orderBy('cate_news_id','desc')->paginate(6);
        return view('admincp.categorynew.list_cate_new',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.categorynew.add_cate_new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $data = $request->validate([
           'cate_news_name' => 'required|max:255',
           'cate_news_status' => 'required' 
       ]);

       $cate_news = new cate_news();
       $cate_news->cate_news_name = $data['cate_news_name'];
       $cate_news->cate_news_status = $data['cate_news_status'];
       $cate_news->save();
       return redirect()->back()->with('status','Bạn đã thêm danh mục tin tức thành công');

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
    public function edit($cate_news_id)
    {
        $data = cate_news::where('cate_news_id', $cate_news_id)->first();
        return view('admincp.categorynew.edit_cate_new')->with(compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cate_news_id)
    {
       $data = array();
       $data['cate_news_name'] = $request->cate_news_name;
       DB::table('tbl_cate_news')->where('cate_news_id',$cate_news_id)->update($data);
        return redirect()->back()->with('status','Bạn đã cập nhật danh mục tin tức thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cate_news_id)
    {
        cate_news::where('cate_news_id', $cate_news_id)->delete();
        return redirect()->back()->with('status','Bạn đã xóa danh mục tin tức thành công');
    }

    //end function cate_news
    // setting cate_new status 
    public function unactive_cate_new($cate_news_id)
    {
        cate_news::where('cate_news_id', $cate_news_id)->update(['cate_news_status'=>1]);
        return redirect()->back()->with('status','Bạn đã hiện thị danh mục tin tức thành công');
       
    }

    public function active_cate_new($cate_news_id)
    {
        cate_news::where('cate_news_id', $cate_news_id)->update(['cate_news_status'=>0]);
        return redirect()->back()->with('status','Bạn đã ẩn danh mục tin tức thành công');
    }
}
