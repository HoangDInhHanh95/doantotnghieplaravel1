<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\cate_news;
use App\Models\SliderBanner;
use App\Models\Contact;

class ContactController extends Controller
{
   public function view_contact()
   {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('id','ASC')->get();
        $brand_products = DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('id','ASC')->get();

        //danh muc tin tuc
        $show_cate_new = cate_news::where('cate_news_status','1')->orderBy('cate_news_id','DESC')->get();

        //show slider banner
        $slider = array();
        $slider['show_slider_home'] = SliderBanner::where('slider_status','1')->orderBy('slider_id','DESC')->take(4)->get();

        return view('admincp.logincustomer.contact_customer',$slider)->with('category',$cate_product)->with('brand_products',$brand_products)->with('show_cate_new',$show_cate_new);
   }

   public function sent_info_shop(Request $request)
   {
         $data = $request->validate([
            'contact_name' => 'required',
            'contact_email' => 'required',
            'contact_phone' => 'required',
            'contact_title' => 'required',
            'contact_desc' => 'required',
         ]);

         $contact = new Contact();
         $contact->contact_name = $data['contact_name'];
         $contact->contact_email = $data['contact_email'];
         $contact->contact_phone = $data['contact_phone'];
         $contact->contact_title = $data['contact_title'];
         $contact->contact_desc = $data['contact_desc'];
         $contact->save();
         return redirect()->back()->with('status','Bạn đã gửi thành công. Chúng tôi sẽ liên hệ với bạn sớm nhất');
   }

   public function show_contact_page_admin()
   {
      $data = array();
      $data['contact_admin'] = Contact::orderBy('contact_id', 'DESC')->paginate(12);
      return view('admincp.logincustomer.show_contact_admin',$data);
   }

   public function delete_contact($contact_id)
   {
      Contact::where('contact_id', $contact_id)->delete();
      return redirect()->back()->with('status','Bạn đã  xóa thành công');
   }

}
