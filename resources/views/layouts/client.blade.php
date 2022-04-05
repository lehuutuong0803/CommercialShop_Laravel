<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>Freshshop - Ecommerce Bootstrap 4 HTML Template</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="/img/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="/css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="/css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="/css/listing.css">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://kit.fontawesome.com/74bf16d8da.js" crossorigin="anonymous"></script>

    <style>
        .dropbtn {
            background-color: #f8f9fa!important;
            color: black;
            padding: 16px;
            font-size: 16px;
            border: none;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {background-color: #ddd;}

        .dropdown:hover .dropdown-content {display: block;}

        .dropdown:hover .dropbtn {background-color: #3e8e41;}
    </style>
</head>

<body id="CartBody">

<!-- Start Main Top -->
<header class="main-header">
    <!-- Start Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
        <div class="container">
            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.html"><img src="/images/logo.png" class="logo" alt=""></a>
            </div>
            <!-- End Header Navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div  class="collapse navbar-collapse" id="navbar-menu">
                <ul  class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                    <li  class="nav-item active"><a class="nav-link" href="http://127.0.0.1:8000/">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="http://127.0.0.1:8000/thong-tin">Chúng tôi</a></li>
                    <li class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle arrow" data-toggle="dropdown">Cửa hàng</a>
                        <ul class="dropdown-menu">
                            <li><a href="shop.html">Sidebar Shop</a></li>
                            <li><a href="shop-detail.html">Shop Detail</a></li>
                            <li><a href="cart.html">Cart</a></li>
                            <li><a href="checkout.html">Checkout</a></li>
                            <li><a href="my-account.html">My Account</a></li>
                            <li><a href="wishlist.html">Wishlist</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="http://127.0.0.1:8000/san-pham">Bộ sưu tập</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact-us.html">Liên lạc</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->

            <!-- Start Atribute Navigation -->
            <div class="attr-nav">
                <ul>

                    <li class="side-menu">
                        <a href="http://127.0.0.1:8000/gio-hang">
                            <i class="fa fa-shopping-bag"></i>
                            <p>Giỏ hàng</p>
                            <?php if(!empty($cart)) {?>
                            <span id="product_amount" class="badge"><?= $cart->totalQuanty ?></span>
                            <?php }else{ ?>
                            <span id="product_amount" class="badge">0</span>
                            <?php   } ?>
                        </a>
                    </li>
                </ul>
            </div>
            <div style="margin-left: 50px" class="attr-nav">

                <?php
                    if(!empty($user)){ ?>


                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <a style="color: black">Xin Chào: <?= $user['name'] ?> <i class="fa-solid fa-user"></i> </a>
                        <button  style="margin-left: 10px; border-style: none; background-color: #f8f9fa!important" type="submit"><i class="fa-solid fa-right-from-bracket"></i></i> Đăng xuất</button>
                        <div class="dropdown">
                            <button class="dropbtn"><i class="fa-solid fa-gear"></i>Thiết lập</button>
                            <div class="dropdown-content">
                                <a href="http://127.0.0.1:8000/gio-hang">Giỏ hàng</a>
                                <a href="http://127.0.0.1:8000/thong-tin-tai-khoan">Tài khoản</a>
                                <a href="http://127.0.0.1:8000/lich-su">Lịch sử mua hàng</a>
                            </div>
                        </div>
                    </form>


                    <?php      }else{ ?>
                    <a href="http://127.0.0.1:8000/login"><i class="fa-solid fa-right-to-bracket"></i> Đăng nhập</a>
                    <a style="margin-left: 15px" href="http://127.0.0.1:8000/register"><i class="fa-solid fa-address-card"></i> Đăng ký</a>
                <?php     }
                ?>




            </div>
            <!-- End Atribute Navigation -->
        </div>
        <!-- Start Side Menu -->
        <div class="side">
            <a href="#" class="close-side"><i class="fa fa-times"></i></a>
            <li class="cart-box">
                <ul class="cart-list">
                    <li>
                        <a href="#" class="photo"><img src="/img/img-pro-01.jpg" class="cart-thumb" alt="" /></a>
                        <h6><a href="#">Delica omtantur </a></h6>
                        <p>1x - <span class="price">$80.00</span></p>
                    </li>
                    <li>
                        <a href="#" class="photo"><img src="/img/img-pro-02.jpg" class="cart-thumb" alt="" /></a>
                        <h6><a href="#">Omnes ocurreret</a></h6>
                        <p>1x - <span class="price">$60.00</span></p>
                    </li>
                    <li>
                        <a href="#" class="photo"><img src="/img/img-pro-03.jpg" class="cart-thumb" alt="" /></a>
                        <h6><a href="#">Agam facilisis</a></h6>
                        <p>1x - <span class="price">$40.00</span></p>
                    </li>
                    <li class="total">
                        <a href="#" class="btn btn-default hvr-hover btn-cart">VIEW CART</a>
                        <span class="float-right"><strong>Total</strong>: $180.00</span>
                    </li>
                </ul>
            </li>
        </div>
        <!-- End Side Menu -->
    </nav>
    <!-- End Navigation -->
</header>
<!-- End Main Top -->

<!-- Start Top Search -->
<div class="top-search">
    <div class="container">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-search"></i></span>
            <input type="text" class="form-control" placeholder="Search">
            <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
        </div>
    </div>
</div>
<!-- End Top Search -->

@yield('content')


<!-- Start Footer  -->
<footer>
    <div class="footer-main">
        <div class="container">

            <hr>
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-widget">
                        <h4>10Real Shop</h4>
                        <p style="color: #FFFFFF">
                            Chúng tôi đã sản xuất những tủ bếp đầu tiên từ năm 2005. Nhu cầu của khách hàng thành đạt khi ấy chỉ là một căn bếp đẹp. Qua năm tháng chúng ta hòa nhập sâu vào xu hướng phát triển của thế giới. Nhu cầu bếp hay phòng ngủ ngày nay không chỉ đẹp, đầy đủ các tiện nghi bên trong mà còn thể hiện được tính cách riêng của mỗi gia đình. 10Real mang nhiều giá trị để anh chị có được những không gian bếp và phòng ngủ thật sự mãn nguyện.</p>

                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-link">
                        <h4>Sứ mệnh</h4>
                        <p style="color: #FFFFFF">Bằng tình yêu và nỗ lực không ngừng, chúng tôi luôn muốn mỗi khách hàng đều được sống và tận hưởng trong những không gian bếp, phòng ngủ sang trọng, tiện nghi với một chi phí hợp lý nhất</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-link-contact">
                        <h4>Liên lạc</h4>
                        <ul>
                            <li>
                                <p><i class="fas fa-map-marker-alt"></i>Địa chỉ: 288/18A Nguyễn Văn Nghi <br>P7 Q.Gò Vấp Tp.Hồ Chí Minh </p>
                            </li>
                            <li>
                                <p><i class="fas fa-phone-square"></i>SĐT: <a href="tel:+1-888705770">0987654321</a></p>
                            </li>
                            <li>
                                <p><i class="fas fa-envelope"></i>Email: <a href="mailto:contactinfo@gmail.com">lehuutuong2027@gmail.com</a></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer  -->

<!-- Start copyright  -->
<div class="footer-copyright">
    <p class="footer-company">10Real Team 2022
</div>
<!-- End copyright  -->

<a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

<!-- ALL JS FILES -->
<script src="/js/jquery-3.2.1.min.js"></script>
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<!-- ALL PLUGINS -->
<script src="/js/jquery.superslides.min.js"></script>
<script src="/js/bootstrap-select.js"></script>
<script src="/js/inewsticker.js"></script>
<script src="/js/bootsnav.js."></script>
<script src="/js/images-loded.min.js"></script>
<script src="/js/isotope.min.js"></script>
<script src="/js/owl.carousel.min.js"></script>
<script src="/js/baguetteBox.min.js"></script>
<script src="/js/form-validator.min.js"></script>
<script src="/js/contact-form-script.js"></script>
<script src="/js/custom.js"></script>
<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>


<script>
    function AddCart(id){
       $.ajax({
           url: 'http://127.0.0.1:8000/them-sp-gio-hang/'+id,
           type: 'GET',
       }).done(function(response){
              $("#product_amount").empty();
              $("#product_amount").html(response);
           alertify.success('Đã thêm sản phẩm');
        });


    }
    function Delete(id){
        $.ajax({
            url: 'http://127.0.0.1:8000/xoa-sp-gio-hang/'+id,
            type: 'GET',
        }).done(function(response){
            $("#CartBody").empty();
            $("#CartBody").html(response);

            alertify.success('Đã xóa sản phẩm');
        });
    }
    function Update(id){

        $.ajax({
            url: 'http://127.0.0.1:8000/cap-nhat-sp-gio-hang/'+id+'/'+ $("#quanty_item_"+id).val(),
            type: 'GET',
        }).done(function(response){
            $("#CartBody").empty();
            $("#CartBody").html(response);

            alertify.success('Đã cập nhật sản phẩm');
        });
    }
    function error(){
        alertify.error('Vui lòng đăng nhập tài khoản');
    }

</script>
</body>

</html>
