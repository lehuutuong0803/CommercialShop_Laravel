@extends('layouts.admin')
@section('content')
    <?php if(!empty($success)){
                if($success == true){ ?>
                    <h3> Thêm sản phẩm thành công!</h3>
              <?php  }else{ ?>
                    <h3> Thêm sản phẩm thất bại!</h3>
             <?php   }
    } ?>
    <form class="form_insert" action="{{route('editing.store',['model'=>$modelName])}}" method="POST" enctype="multipart/form-data">
        @csrf
        <h3 style="color: #FFF; text-align: center; margin-top: 5px "> Tạo mới </h3>
        <?php if(!empty($configs)) {
                foreach ($configs as $config){
                    switch ($config['type']){
                        case 'text':
                            $field = $config['field'] ?>

                            <div class="insert">
                                <label style="margin-top: 15px"><?= $config['name'] ?>: </label>
                                <div >
                                    <input class="@error($field) is-invalid @enderror"  type="text" size="65" name="<?= $config['field'] ?>" placeholder="<?= htmlspecialchars($config['name']) ?>"/>
                                    @error($field)
                                        <div style="margin-left: 35px; color: red" class=" alert alert-light max-width-500"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                         <?php   break;
                        case 'number':
                            $field = $config['field'] ?>

                            <div class="insert">
                                <label><?= $config['name'] ?>: </label>
                                <div >
                                    <input type="number" class="@error($field) is-invalid @enderror" size="65" name="<?= $config['field'] ?>" placeholder="<?= htmlspecialchars($config['name']) ?>"/>
                                    @error($field)
                                    <div style="margin-left: 35px; color: red" class=" alert alert-light max-width-500"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                         <?php   break;
                        case 'image':
                              $field = $config['field'] ?>
                            <div class="insert">
                                <label><?= $config['name'] ?>: </label>
                                <div >
                                    <input style="background-color: #FFFFFF" type="file" class="@error($field) is-invalid @enderror" size="65" name="<?= $config['field'] ?>" />
                                    @error($field)
                                    <div style="margin-left: 35px; color: red" class=" alert alert-light max-width-500"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                       <?php     break;
                        case 'textarea':
                         $field = $config['field']?>
                        <div class="insert">
                            <label><?= $config['name'] ?>: </label>
                            <div >
                                <textarea class="@error($field) is-invalid @enderror" type="text" rows="3" name="<?= $config['field'] ?>" ></textarea>
                            </div>
                        </div>
                        <?php     break;
                        case 'foreign_key':
                        $field = $config['field']?>
                        <div class="insert">
                            <label><?= $config['name'] ?>: </label>

                            <select class="@error($field) is-invalid @enderror" name="<?= $config['field'] ?>" id="<?= $config['field'] ?>">
                            <?php
                                if(!empty($cates)) {
                                    foreach ($cates as $cate) { ?>

                                <option value="<?= $cate['id'] ?>"><?= $cate['name_cate'] ?></option>
                                <?php
                                    }
                                } ?>
                            </select>
                        </div>
                        <?php     break;
                    }
                }
        }?>
            <button style="margin-left: 320px; margin-top: 20px; background-color: #FFF; color: #e02c68" class="btn btn-primary" type="submit">Thêm mới</button>
    </form>

@endsection
