<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\product;

session_start();

class AdminControlller extends Controller
{
    public function Authenlogin(){
        $admin_id =  Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/admincp/quantri');
        }else{
            return Redirect::to('/logout')->send();
        }
    }
    public function index(){
        return view('admincp.admin_login');
    }

    public function show_dashbord(){
         $this->Authenlogin();
        return view('admincp.quantri.dashbord');
    }

    // kiểm tra password and email trong Database
    public function dashbordone(Request $request){
       

        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);

        $result = Admin::where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();// => lấy chỉ một user thôi
        
        if($result){
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_id',$result->id);
            return view('admincp.quantri.dashbord'); 
        }
        else{
            Session::put('message','Tài khoản hoặc mật khẩu không đúng. Vui lòng kiểm tra lại');
            return view('admincp.admin_login');
        }

    }

    public function logout(Request $request)
    {
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return view('admincp.admin_login');
    }

    




}
