@extends('layouts.client')
@section('content')
    <!-- Start All Title Box -->
    <div style="background-color: #b0b435" class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 style="font-size: 35px">Chi tiết sản phẩm</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="http://127.0.0.1:8000/">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Shop</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Shop Detail  -->
    <div class="shop-detail-box-main">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active"> <img style=" height: 480px" class="d-block w-100" src="<?= $product['img'] ?>" alt="First slide"> </div>
                        </div>

                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <div class="single-product-details">
                        <h2><?= $product['name_product'] ?></h2>
                        <h5>  <?= number_format($product['sale_price'],0,',','.') ?>₫</h5>
                        <p class="available-stock"><span> Số lượng: <?= $product['amount'] ?> </span><p>
                        <h4>Short Description:</h4>
                        <p> <?= $product['details'] ?> </p>
                        <ul>
                            <li>
                                <div class="form-group quantity-box">
                                    <label class="control-label">Quantity</label>
                                    <input class="form-control" value="0" min="0" max="20" type="number">
                                </div>
                            </li>
                        </ul>

                        <div class="price-box-bar">
                            <div class="cart-and-bay-btn">
                                <a class="btn hvr-hover" data-fancybox-close="" href="#">Thêm vào giỏ hàng</a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="card card-outline-secondary my-4">
                    <div class="card-header">
                        <h2>Bình luận</h2>
                    </div>
                    <div class="card-body">

                        <?php foreach ($comments as $commnet) {?>
                        <div class="media mb-3">
                            <div class="mr-2">
                                <i class="fa-solid fa-user"> #<?= $commnet['id_user'] ?></i>
                            </div>
                            <div class="media-body">
                                <p><?= $commnet['content'] ?></p>
                                <small class="text-muted"><?= $commnet['created_at'] ?></small>
                            </div>
                        </div>

                            <?php }?>

                        <hr>
                            <?php if(empty($user)){?>
                            <input size="100px" style="height: 38px"  name="comment" placeholder="Nhập bình luận của bạn..." value="">
                            <br>
                            <button onclick="error()"  style="color: #FFFFFF;margin-left: 20px;margin-top: 10px " class="btn hvr-hover">Bình luận </button>
                            <?php     }else{?>
                            <form  action="{{route('home.comment',['id'=>$product['id']])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input size="100px" style="height: 38px" name="comment" placeholder="Nhập bình luận của bạn..." value="">
                                <br>
                                <button  style="color: #FFFFFF;margin-left: 20px;margin-top: 10px " class="btn hvr-hover">Bình luận </button>
                            </form>
                            <?php }?>


                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Sản phẩm liên qua</h1>
                    </div>
                    <div class="featured-products-box owl-carousel owl-theme">
                        <?php foreach ($relativeProduct as $item) { ?>
                                <div class="item">
                                    <div class="products-single fix">
                                        <div class="box-img-hover">
                                            <img style="height: 200px" src="<?= $item['img'] ?>" class="img-fluid" alt="Image">
                                            <div class="mask-icon">
                                                <ul>
                                                    <li><a href="{{route('home.gallery_details',['id'=>$item['id']])}}" data-toggle="tooltip" data-placement="right" title="Chi tiết"><i class="fas fa-eye"></i></a></li>
                                                </ul>
                                                <a class="cart" href="#">Thêm giỏ hàng</a>
                                            </div>
                                        </div>
                                        <div class="why-text">
                                            <h4><?= $item['name_product'] ?></h4>
                                            <h5>  <?= number_format($product['sale_price'],0,',','.') ?>₫</h5>
                                        </div>
                                    </div>
                                </div>
                        <?php } ?>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->
@endsection
