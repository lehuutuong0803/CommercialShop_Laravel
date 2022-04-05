@extends('layouts.client')
@section('content')

    <div >
        <!-- Start All Title Box -->
        <div style="background-color: #b0b435" class="all-title-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 style="font-size: 35px">Chi tiết hóa đơn - #<?= $id_invoice ?> </h2>
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
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                                </thead>
                                <tbody >
                                <?php foreach ($details as $detail ) {?>
                                <tr>
                                    <?php foreach ($productList as $product){
                                        if($product['id'] == $detail['id_product']){ ?>

                                        <td class="name-pr">
                                            <a href="#">
                                                <img style="height: 100px;width: 100px" class="img-fluid" src="<?= $product['img'] ?>" alt="" />
                                            </a>
                                        </td>
                                        <td class="name-pr">
                                            <a href="#">
                                                <?= $product['name_product'] ?>
                                            </a>
                                        </td>


                                     <?php   }
                                    }?>

                                    <td class="price-pr">
                                            <p> <?= $detail['quantity'] ?></p>
                                    </td>
                                    <td class="quantity-box">
                                        <p  type="text" >  <?= number_format($detail['into_money'],0,',','.') ?>₫</p>
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


    </div>



@endsection
