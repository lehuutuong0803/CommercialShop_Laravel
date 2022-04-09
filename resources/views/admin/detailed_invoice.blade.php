@extends('layouts.admin')
@section('content')


    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Chi tiết hóa đơn _- <?= $id_invoice ?></h6>
                        </div>
                    </div>

                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hình ảnh</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên sản phẩm</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Số lượng</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Thành tiền</th>
                                </tr>
                                </thead>
                                <tbody >
                                <?php foreach ($details as $detail ) {?>
                                <tr>
                                    <?php foreach ($productList as $product){
                                    if($product['id'] == $detail['id_product']){ ?>

                                    <td  class="align-middle text-center text-sm">
                                        <a href="#">
                                            <img style="height: 100px;width: 100px" class="img-fluid" src="<?= $product['img'] ?>" alt="" />
                                        </a>
                                    </td>
                                    <td  class="align-middle text-center text-sm">
                                        <a href="#">
                                            <?= $product['name_product'] ?>
                                        </a>
                                    </td>


                                    <?php   }
                                    }?>

                                    <td  class="align-middle text-center text-sm">
                                        <p> <?= $detail['quantity'] ?></p>
                                    </td>
                                    <td  class="align-middle text-center text-sm">
                                        <p  type="text" >  <?= number_format($detail['into_money'],0,',','.') ?>₫</p>
                                    </td>
                                </tr>

                                <?php } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer py-4  ">

        </footer>
    </div>

@endsection
