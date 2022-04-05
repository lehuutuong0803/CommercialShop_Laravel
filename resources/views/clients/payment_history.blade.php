@extends('layouts.client')
@section('content')

    <div >
        <!-- Start All Title Box -->
        <div style="background-color: #b0b435" class="all-title-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 style="font-size: 35px">Lịch sử hóa đơn</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="http://127.0.0.1:8000/">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Shop</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End All Title Box -->
        <!-- Start Cart  -->
        <?php

        if(empty($invoice)){
            echo "<h1> Bạn chưa có đơn hàng nào </h1>";
        }else{ ?>
        <div id="CartBody" class="cart-box-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-main table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Người mua</th>
                                    <th>Địa chỉ</th>
                                    <th>Tổng tiền</th>
                                    <th>Số lượng</th>
                                    <th>Tình trạng</th>
                                    <th>Ngày tạo</th>
                                    <th>Xem chi tiết</th>
                                </tr>
                                </thead>
                                <tbody >
                                <?php foreach ($invoice as $item ) {?>
                                <tr>
                                    <td class="thumbnail-img">
                                        <a href="#">
                                            #<?= $item['id'] ?>
                                        </a>
                                    </td>
                                    <td class="name-pr">
                                        <a href="#">
                                            <?= $user['name'] ?>
                                        </a>
                                    </td>
                                    <td class="price-pr">
                                        <p> <?= $item['address'] ?></p>
                                    </td>
                                    <td class="quantity-box">
                                        <p  type="text" >  <?= number_format($item['total'],0,',','.') ?>₫</p>
                                    </td>
                                    <td class="total-pr">
                                        <p><?= $item['quantity'] ?></p>
                                    </td>
                                    <td  class="remove-pr">
                                        <p><?= $item['status'] ?></p>
                                    </td>
                                    <td  class="remove-pr">
                                        <p><?= $item['created_at'] ?></p>
                                    </td>
                                    <td class="name-pr">
                                        <a href="http://127.0.0.1:8000/chi-tiet-hoa-don/<?= $item['id'] ?>">Xem</a>
                                    </td>
                                </tr>

                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row my-5">
                    <div class="col-lg-6 col-sm-6">
                        <div class="coupon-box">

                        </div>
                    </div>
                </div>



            </div>
        </div>
        <!-- End Cart -->
        <?php   }

        ?>
    </div>



@endsection
