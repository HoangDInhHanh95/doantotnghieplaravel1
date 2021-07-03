<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use App\Models\gallery;

use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class galleryController extends Controller
{
    public function Authenlogin(){
        $admin_id =  Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/admincp/quantri');
        }else{
            return Redirect::to('/logout')->send();
        }
    }

    // hiên thị hình ảnh ra table
    public function add_gallery($product_id)
    {
        $pro_id = $product_id; // lấy id product
        return view('admincp.gallery.add_gallery')->with(compact('pro_id'));
    }

    // edit tên hình ảnh trong thư viện => đang bị lỗi
    public function update_name_img_gallery(Request $request)
    {
        $gal_id = $request->gal_id;
   
    	$gal_text = $request->gal_text;
    	$gallery = gallery::find($gal_id);
	    $gallery->gallery_name = $gal_text;
		$gallery->save();
    }

    public function select_gallery(Request $request)
    {
       $product_id = $request->pro_id; // => get product_id in table product
       $gallery = gallery::where('product_id',$product_id)->get(); //=> lấy trong model => gallery
        $gallery_count = $gallery->count();
       $output = '
            <form>
            '.csrf_field().'
            <table class="table table-hover">
            <thead>
                <tr>
                <th>STT</th>
                <th>Tên hình ảnh</th>
                <th>Hình ảnh</th>
                <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
       
       ';
        if($gallery_count > 0){
            $i = 0;
            foreach($gallery as $key => $gal_value){
                    $i++;
                    $output.= '
                        <tr>
                            <td>'.$i.'</td>
                            <td contenteditable class="edit_name_image" data-gal_id ="'.$gal_value->gallery_id.'" name="name_img">'.$gal_value->gallery_name.'</td>
                                                
                            <td>
                                <img src="'.url('uploads/gallery/'.$gal_value->gallery_image).'" class="img-thumbnail" width="100" height="100" alt="Thư viên ảnh">
                            </td>

                            <td>
                                <button type="button" data-gal_id="'.$gal_value->gallery_id.'" class="btn btn-xs btn-danger delete-gallery">
                                    Xóa
                                </button>
                            </td>
                        </tr> 
                    ';     
                }
        }else{
                $output.= '
                    <tr>
                        <td colspan="4">Sản phẩm này bạn chưa thêm thư viện ảnh</td>
                    </tr> 
                ';
        }
        $output.= '
                   </tbody>
                   </table>
                   </form>
                ';
        echo $output;




    }

    //insert thu vien anh
    public function insert_gallery_image($prod_id,Request $request)
    {
        $get_allImage = $request->file('file');

        if($get_allImage)
        {
            foreach ($get_allImage as $image)
            {
                $get_name_image = $image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                //getClientOriginalExtension()=> lấy phân đuôi (png,jpg,jpeg) mở rông của image
                $new_imege = $name_image.rand(0,9999999).'.'.$image->getClientOriginalExtension();
                $image->move('uploads/gallery',$new_imege);
                $gallery = new gallery();
                $gallery->gallery_name = $new_imege;
                $gallery->gallery_image = $new_imege;
                $gallery->product_id = $prod_id;
                $gallery->save();
            }
        }
        return redirect()->back()->with('status','Bạn đã thêm thư viên ảnh thành công');
    }

    // co the thu unlink
    //xoa ảnh trong thư viện ảnh
    public function delete_gallery(Request $request)
    {
        $gal_id = $request->gal_id;
        Session::put('gal_id',$gal_id);
        DB::table('tbl_gallery')->where('gallery_id',$gal_id)->delete();
        // unlink('uploads/gallery/'.$tbl_gallery->gallery_image);
        // $tbl_gallery->delete();
    }
    
    // cập nhật hình ảnh trong thư viện hinh ảnh product
    public function update_gallery(Request $request)
    {
        // name = file
        // $data = array();
        $get_image = $request->file('file');
        $get_id = $request->gal_id;
        if($get_image)
        {
            
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                //getClientOriginalExtension()=> lấy phân đuôi (png,jpg,jpeg) mở rông của image
                $new_imege = $name_image.rand(0,9999999).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('uploads/gallery',$new_imege);
                // $data['file'] = $new_imege;
                // $data['name_img'] = $new_image;

                // DB::table('tbl_gallery')->where('gallery_id',$get_id)->update($data);
                $gallery = gallery::where('gallery_id',$get_id);
                unlink('uploads/gallery/'.$gallery->gallery_image);
                $gallery->gallery_image = $new_imege;
                $gallery->gallery_name = $new_imege;
                $gallery->save();
            
        }
        return redirect()->back()->with('status','Bạn đã cập nhật thư viên ảnh thành công');
    }

    


}
