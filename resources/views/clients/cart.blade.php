@extends('layouts.client')
@section('content')
    <div >
    <!-- Start All Title Box -->
    <div style="background-color: #b0b435" class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 style="font-size: 35px">Giỏ hàng</h2>
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

        if(empty($cart)){
            echo "<h1> Không có sản phẩm trong giỏ hàng </h1>";
        }else{ ?>
    <div id="CartBody" class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Cập nhật</th>
                                <th>Xóa</th>
                            </tr>
                            </thead>
                            <tbody >
                            <?php foreach ($cart->products as $item ) {?>
                                <tr>

                                    <td class="thumbnail-img">
                                        <a href="#">
                                            <img class="img-fluid" src="<?= $item['productInfo']->img ?>" alt="" />
                                        </a>
                                    </td>
                                    <td class="name-pr">
                                        <a href="#">
                                            <?= $item['productInfo']->name_product ?>
                                        </a>
                                    </td>
                                    <td class="price-pr">
                                        <p><?= $item['productInfo']->sale_price ?></p>
                                    </td>
                                    <td class="quantity-box"><input id="quanty_item_<?= $item['productInfo']->id ?>" type="number" size="4" value="<?= $item['quanty'] ?>" min="0" step="1" class="c-input-text qty text"></td>
                                    <td class="total-pr">
                                        <p><?= $item['price'] ?></p>
                                    </td>
                                    <td  class="remove-pr">
                                        <i onclick="Update(<?= $item['productInfo']->id ?>)"  class="fa-solid fa-floppy-disk"></i>
                                    </td>

                                    <td class="remove-pr">
                                        <i onclick="Delete(<?= $item['productInfo']->id ?>)" class="fas fa-times"></i>
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

            <div class="row my-5">
                <div class="col-lg-8 col-sm-12"></div>
                <div class="col-lg-4 col-sm-12">
                    <div class="order-box">

                        <hr>
                        <div class="d-flex gr-total">
                            <h5>Tổng tiền:</h5>
                            <div class="ml-auto h5"><?= number_format($cart->totalPrice,0,',','.') ?>₫  </div>
                        </div>
                        <hr> </div>
                </div>
                <?php if(empty($user)){?>
                    <div class="col-12 d-flex shopping-box"><a onclick="error()" class="ml-auto btn hvr-hover">Thanh toán</a> </div>
                 <?php     }else{?>
                     <div class="col-12 d-flex shopping-box"><a href="http://127.0.0.1:8000/thanh-toan" class="ml-auto btn hvr-hover">Thanh toán</a> </div>
               <?php }?>

            </div>

        </div>
    </div>
    <!-- End Cart -->
     <?php   }

    ?>
     </div>



@endsection
