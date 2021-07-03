@extends('welcome')
@section('content')
<div class="col-sm-12">
    {{-- status thông báo lỗi --}}
    @if (session('status'))
        <div class="alert alert-success" style="color: red;">
            {{ session('status') }}
        </div>
    @endif 
    <div class="contact-form">
        <h2 class="title text-center">Nhập thông tin để được trợ giúp</h2>
        <div class="status alert alert-success" style="display: none"></div>

        <form id="main-contact-form" action="{{ url('/sent-info-shop') }}" class="contact-form row" name="contact-form" method="post">
            @csrf
            <div class="form-group col-md-4">
                <input type="text" name="contact_name" class="form-control" required="required" placeholder="Vui lòng nhập tên của bạn">
            </div>
            <div class="form-group col-md-4">
                <input type="email" name="contact_email" class="form-control" required="required" placeholder="Nhập Email của bạn ">
            </div>
            <div class="form-group col-md-4">
                <input type="text" name="contact_phone" class="form-control" required="required" placeholder="Số điện thoại ">
            </div>
            <div class="form-group col-md-12">
                <input type="text" name="contact_title" class="form-control" required="required" placeholder="Vui lòng nhập vấn đề cần liện hệ">
            </div>
            <div class="form-group col-md-12">
                <textarea name="contact_desc" id="message" required="required" class="form-control" rows="8" placeholder="Mô tả thêm vấn để liên hệ "></textarea>
            </div>                        
            <div class="form-group col-md-12">
                <input type="submit" name="submit_contact" class="btn btn-primary pull-right" value="Submit">
            </div>
        </form>
    </div>

    <div class="col-lg-12">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.021180589528!2d106.68169491410607!3d10.885993360140128!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174d7d1a319a2d5%3A0x2423a848a59e3871!2zOTYsIDkgxJDGsOG7nW5nIFRMIDQxLCBUaOG6oW5oIEzhu5ljLCBRdeG6rW4gMTIsIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1624807585990!5m2!1svi!2s" style="border:0; width: 100%; height: 400px;" allowfullscreen="" loading="lazy"></iframe>
    </div>

</div>
@endsection