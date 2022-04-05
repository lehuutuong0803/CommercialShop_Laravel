@extends('layouts.client')
@section('content')
    <div >
        <!-- Start All Title Box -->
        <div style="background-color: #b0b435" class="all-title-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 style="font-size: 35px"><i class="fa-solid fa-user"></i>  Thông tin tài khoản </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="http://127.0.0.1:8000/">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Shop</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top: 35px;margin-left: 500px">
            <div class="insert">
                <label style="color: black"> <b>Tên người dùng:</b> </label>
                <div >
                    <h2 style="margin-left: 100px" type="text" > <?= $user['name'] ?> </h2>
                </div>
            </div>
            <div class="insert">
                <label style="color: black" ><b>Email:</b> </label>
                <div >
                    <h2 style="margin-left: 100px" type="text" > <?= $user['email'] ?> </h2>
                </div>
            </div>
            <div class="insert">
                <label style="color: black" > <b>Địa chỉ:</b> </label>
                <div >
                    <h2 style="margin-left: 100px" type="text" > <?= $user['address'] ?> </h2>
                </div>
            </div>
            <div class="insert">
                <label style="color: black" > <b>SĐT: </b></label>
                <div >
                    <h2 style="margin-left: 100px" type="text" > <?= $user['number_phone'] ?> </h2>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
        <ul style="background-color: #b0b435; width: 500px; margin-left: 450px;margin-top: 30px; " class="breadcrumb">
            <li  class="breadcrumb-item"><a style="margin-left: 155px; font-size: 20px" href="http://127.0.0.1:8000/chinh-sua-tai-khoan">Chỉnh sửa thông tin</a></li>
        </ul>
            <ul style="background-color: #b0b435; width: 500px; margin-left: 450px ; margin-bottom: 100px" class="breadcrumb">
                <li  class="breadcrumb-item"><a style="margin-left: 180px; font-size: 20px" href="http://127.0.0.1:8000/">Đổi mật khẩu</a></li>
            </ul>
        </div>
    </div>



@endsection
