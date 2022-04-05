@extends('layouts.admin')
@section('content')

    <div>
        <form class="filter-form" action="{{route('listing.index',['model'=>$modelName])}}" method="POST">
            @csrf
            <fieldset>
                <?php foreach ($configs as $config) {
                       if(!empty($config['filter'])){
                           switch ($config['filter']){
                               case "equal":?>
                                <div class="filter-item">
                                    <label><?= $config['name'] ?>: </label>
                                    <input type="text" name="<?= $config['field'] ?>" value="<?= (!empty($config['filter_value'])) ? $config['filter_value'] : "" ?>"/>
                                </div>
                            <?php  break;
                                case "like":?>
                                <div class="filter-item">
                                    <label><?= $config['name'] ?>: </label>
                                    <input type="text" name="<?= $config['field'] ?>" value="<?= (!empty($config['filter_value'])) ? $config['filter_value'] : "" ?>"/>
                                </div>
                                <?php  break;
                                case "between":?>
                                <div class="filter-item">
                                    <label><?= $config['name'] ?> từ: </label>
                                    <input type="number" name="<?= $config['field'] ?>[from]" value="<?= (!empty($config['filter_from_value'])) ? $config['filter_from_value'] : "" ?>"/>
                                </div>
                                <div class="filter-item">
                                    <label>Đến: </label>
                                    <input type="number" name="<?= $config['field'] ?>[to]" value="<?= (!empty($config['filter_to_value'])) ? $config['filter_to_value'] : "" ?>"/>
                                </div>
                                <?php  break;
                           }
                    }
                } ?>
                <button class="btn btn-primary" type="submit">Tìm</button>
            </fieldset>
        </form>


    </div>
    <?php
        if($modelName == "Product" || $modelName == "Category"){ ?>
            <div>
                <a style="margin-left: 45px" href="{{route('editing.create',['model'=>$modelName])}}" class="btn btn-primary" >Tạo mới <i class="fa-solid fa-plus"></i> </a>
            </div>

     <?php     }
    ?>
    <div>
        <?php if(!empty($success)){
        if($deleting == true){ ?>
        <h3> Xóa thành công!</h3>
        <?php  }else{ ?>
        <h3> Xóa thất bại!</h3>
        <?php   }
        } ?>
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3"><?php
                                    if(isset($namePage)){
                                        echo $namePage;
                                    }
                                ?></h6>
                        </div>
                    </div>

                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <?php foreach ($configs as $config) {
                                        if($config['type'] !="edit" && $config['type'] !="delete"){
                                        if($orderBy['field'] == $config['field']){
                                            if($orderBy['sort'] =="desc"){
                                            ?>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><?= $config['name'] ?> <a style="margin-left: 8px"  href="{{route('listing.index',['model'=>$modelName,'sort'=>$config['field'].'_asc'])}}">  <i class="fa-solid fa-sort-down"></i></a></th>
                                    <?php
                                          }else{?>
                                             <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><?= $config['name'] ?> <a style="margin-left: 8px"  href="{{route('listing.index',['model'=>$modelName,'sort'=>$config['field'].'_desc'])}}">  <i class="fa-solid fa-sort-up"></i></a></th>
                                       <?php }
                                        }else{ ?>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><?= $config['name'] ?> <a style="margin-left: 8px"  href="{{route('listing.index',['model'=>$modelName,'sort'=>$config['field'].'_asc'])}}">   <i  class="fa-solid fa-sort"></i></a></th>
                                       <?php }
                                        }else{ ?>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><?= $config['name'] ?> </th>
                                       <?php }
                                    } ?>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($records as $record) {

                                    ?>
                                <tr>
                                    <?php foreach ($configs as $config) { ?>
                                        <?php switch ($config['type']){
                                            case "text": ?>
                                        <td  class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0"><?= $record[$config['field']] ?></p>

                                        </td>
                                        <?php break;
                                                case "foreign_key": ?>
                                                <td  class="align-middle text-center text-sm">
                                                    <p class="text-xs font-weight-bold mb-0"><?= $record[$config['field']] ?></p>

                                                </td>
                                                <?php break;
                                            case "textarea": ?>
                                            <td  class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0"><?= $record[$config['field']] ?></p>
                                            </td>
                                            <?php break;
                                            case "image":?>
                                        <td  class="align-middle text-center text-sm">
                                            <img height="180px" width="220px" src="<?= $record[$config['field']] ?>" class="text-xs font-weight-bold mb-0"></img>
                                        </td>
                                        <?php break;
                                        case "number":?>
                                        <td  class="align-middle text-center text-sm">
                                            <?= number_format($record[$config['field']],0,',','.') ?>₫
                                        </td>
                                        <?php break;?>
                                        <?php
                                        case "edit":?>
                                        <td  class="align-middle text-center text-sm">
                                            <a href="http://127.0.0.1:8000/quan-tri/chinh-sua/<?= $modelName ?>/<?= $record['id'] ?>"><img style="width:32px;height:32px;" src="/assets/img/edit.png"></a>
                                        </td>
                                        <?php break;?>
                                        <?php
                                        case "delete":?>
                                        <td  class="align-middle text-center text-sm">
                                            <a href="http://127.0.0.1:8000/quan-tri/xoa/<?= $modelName ?>/<?= $record['id'] ?>""><img style="width:32px;height:32px;" src="/assets/img/delee.png"></a>
                                        </td>
                                        <?php break;?>


                                   <?php }?>

                                        <?php } ?>

                                </tr>
                                <?php }?>
                                </tbody>
                            </table>
                            <?= $records -> links("pagination::bootstrap-4") ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer py-4  ">

        </footer>
    </div>

@endsection
