@extends('layouts.client')
@section('content')
    <div >
        <!-- Start All Title Box -->
        <div style="background-color: #b0b435" class="all-title-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 style="font-size: 35px"><i class="fa-solid fa-user"></i> Chỉnh sửa thông tin </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="http://127.0.0.1:8000/">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Shop</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top: 35px;margin-left: 500px">
            <form  action="{{route('home.editing_profile_active')}}" method="POST" >
                @csrf
            <div class="insert">
                <label style="color: black"> <b>Tên người dùng:</b> </label>
                <div >
                    <input size="35px" name="name"  style="margin-left: 100px" type="text" value="<?= $user['name'] ?>" />
                </div>
            </div>
            <div class="insert">
                <label style="color: black" ><b>Email:</b> </label>
                <div >
                    <input size="35px" name="email" style="margin-left: 100px" type="text" value="<?= $user['email'] ?>" />
                </div>
            </div>
            <div class="insert">
                <label style="color: black" > <b>Địa chỉ:</b> </label>
                <div >
                    <input size="35px" name="address" style="margin-left: 100px" type="text" value="<?= $user['address'] ?>" />
                </div>
            </div>
            <div class="insert">
                <label style="color: black" > <b>SĐT: </b></label>
                <div >
                    <input size="35px" name="number_phone" style="margin-left: 100px" type="text" value="<?= $user['number_phone'] ?>" />
                </div>
            </div>
                <button class="button-update">Cập nhật</button>
            </form>
        </div>
        <div class="col-lg-12">
            <ul style="background-color: #b0b435; width: 500px; margin-left: 485px; margin-top: 30px ; margin-bottom: 100px" class="breadcrumb">
                <li  class="breadcrumb-item"><a style="margin-left: 180px; font-size: 20px" href="http://127.0.0.1:8000/">Đổi mật khẩu</a></li>
            </ul>
        </div>
    </div>



@endsection
