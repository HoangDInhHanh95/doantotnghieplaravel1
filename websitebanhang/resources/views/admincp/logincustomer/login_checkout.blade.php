@extends('welcome')
@section('content')

<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Đăng nhập</h2>
                    <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session::put('message',null);
                        }
                    ?>
                    <form action="{{URL('/login-account-customer')}}" method="post">
                        @csrf
                        <input type="text" name="email_account" placeholder="Tài khoản" />
                        <input type="password" name="password_account" placeholder="nhập mật khẩu" />
                        <span>
                            <input type="checkbox" class="checkbox"> 
                           Ghi nhớ đăng nhập
                        </span>
                        <button type="submit" class="btn btn-default">Đăng nhập</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>Đăng ký </h2>
                    <form action="{{URL('/add-customer')}}" method="POST">
                        @csrf
                        <input type="text" name="customer_name" placeholder="Họ và tên "/>
                        <input type="email" name="customer_email" placeholder="Địa chỉ email"/>
                        <input type="password" name="customer_password" placeholder="Mật khẩu"/>
                        <input type="text" name="customer_address"  placeholder="Địa chỉ"/>
                        <input type="text" name="customer_phone" placeholder="Số điện thoại"/>
                        <button type="submit" name="customer_register" class="btn btn-default">Đăng ký</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->









@endsection