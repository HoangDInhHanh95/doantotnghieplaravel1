<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\SliderBanner;

class SliderBannerController extends Controller
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
    // show in page admin
    public function index()
    {
        $this->Authenlogin();
        $data = array();
        $data['show_slider'] = SliderBanner::orderBy('slider_id', 'DESC')->paginate(6);
        return view('admincp.slider.list_slider_banner',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->Authenlogin();
        return view('admincp.slider.add_slider_banner');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->Authenlogin();
       $data = $request->all();
       
        $get_image = $request->file('slider_image');
        if($get_image)
        {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));

            //getClientOriginalExtension()=> lấy phân đuôi (png,jpg,jpeg) mở rông của image
            $new_imege = $name_image.rand(0,9999999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/sliderimage',$new_imege);

            $slider = new SliderBanner();

            $slider->slider_title = $data['slider_title'];
            $slider->slider_image = $new_imege;
            $slider->slider_desc = $data['slider_desc'];
            $slider->slider_status = $data['slider_status'];
            $slider->save();            
            return redirect()->back()->with('status','Bạn đã thêm slider thành công');
        }else{
            return redirect()->back()->with('status','Bạn đã quên thêm hình ảnh');
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slider_id)
    {
        SliderBanner::where('slider_id', $slider_id)->delete();
        return redirect()->back()->with('status','Bạn đã xóa slider thành công');
    }

    // end slider 
    // setting slider status 
    public function unactive_slider($slider_id)
    {
        SliderBanner::where('slider_id', $slider_id)->update(['slider_status'=>1]);
        return redirect()->back()->with('status','Bạn đã hiện thị slider thành công');
       
    }

    public function active_slider($slider_id)
    {
        SliderBanner::where('slider_id', $slider_id)->update(['slider_status'=>0]);
        return redirect()->back()->with('status','Bạn đã ẩn slider thành công');
    }
}
