@extends('layouts.client')
@section('content')

    <!-- Start All Title Box -->
    <div style="background-color: #b0b435" class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Sản phẩm</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="http://127.0.0.1:8000/">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Shop</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Shop Page  -->
    <div class="shop-box-inner">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
                    <div class="right-product-box">
                        <div class="product-item-filter row">
                            <div class="col-12 col-sm-8 text-center text-sm-left">

                                <div class="toolbar-sorter-right">
                                    <span>Sắp xếp </span>
                                    <span> <a style="margin-left: 8px"  href="{{route('home.gallery',['sort'=>'sale_price_desc'])}}"> <i  class="fa-solid fa-sort"></i>Giá cao -> Thấp</a></span>
                                    <span> <a style="margin-left: 8px"  href="{{route('home.gallery',['sort'=>'sale_price_asc'])}}"> <i  class="fa-solid fa-sort"></i> Giá thấp -> cao</a></span>
                                </div>
                            </div>

                        </div>

                        <div class="product-categorie-box">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                    <div class="row">
                                    <?php foreach ($records as $record) {
                                        ?>

                                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                            <div class="products-single fix">
                                                <div class="box-img-hover">
                                                    <div class="type-lb">
                                                        <p class="sale">Sale</p>
                                                    </div>
                                                    <img style="height: 200px" src="<?= $record['img'] ?>" class="img-fluid" alt="Image">
                                                    <div class="mask-icon">
                                                        <ul>
                                                            <li><a href="{{route('home.gallery_details',['id'=>$record['id']])}}" data-toggle="tooltip" data-placement="right" title="Chi tiết"><i class="fas fa-eye"></i></a></li>
                                                        </ul>
                                                        <a class="cart" onclick="AddCart(<?= $record['id']?>)" >Thêm giỏ hàng</a>
                                                    </div>
                                                </div>
                                                <div class="why-text">
                                                    <h4><?= $record['name_product'] ?></h4>
                                                    <h5>  <?= number_format($record['sale_price'],0,',','.') ?>₫</h5>
                                                </div>
                                            </div>
                                        </div>



                                <?php } ?>
                                    </div>
                                </div>
                                <?= $records -> links("pagination::bootstrap-4") ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
                    <div class="product-categori">
                        <div class="search-product">


                            <form action="{{route('home.gallery')}}"  method="POST">
                                @csrf
                                <input name="name_product" style="background-color: #111010; color: #FFFFFF" class="form-control" placeholder="Tìm kiếm..." type="text">
                                <button type="submit"> <i class="fa fa-search"></i> </button>
                            </form>


                        </div>

                        <div class="filter-sidebar-left">
                            <div class="title-left">
                                <h3>Loại sản phẩm</h3>
                            </div>
                            <div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">

                                <div class="list-group-collapse sub-men">
                                    <a style="margin-left: 20px;margin-top: 5px" class=" list-group-item-action" href="{{route('home.gallery')}}"  >Tất cả</a>
                                </div>
                               <?php foreach ($cateList as $cate) {?>

                                <div class="list-group-collapse sub-men">
                                    <a style="margin-left: 20px;margin-top: 5px" class=" list-group-item-action" href="{{route('home.gallery',['cate'=>$cate['id']])}}"  ><?= $cate['name_cate'] ?></a>
                                </div>
                           <?php  }   ?>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Shop Page -->
@endsection
