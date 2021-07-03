<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class ckeditorController extends Controller
{
    public function ckeditor_images(Request $request)
    {
        if($request->hasFile('upload')){
            $originName = $request->file('upload')->getClientOriginalName();

            $filename = pathinfo($originName, PATHINFO_FILENAME);

            $extension = $request->file('upload')->getClientOriginalExtension();

            $filename = $filename.'_'.time().'.'.$extension;

            $request->file('upload')->move('uploads/ckeditor', $filename);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');

            $url =  asset('uploads/ckeditor/'.$filename);

            $msg = 'Tải thành công';
            
            $response = "<script> window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url','$msg')</script> ";

            @header('Content-type: text/html; charset=utf-8');

            echo $response;


        }
    }
}
