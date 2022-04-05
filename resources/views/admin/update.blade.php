@extends('layouts.admin')
@section('content')
    <?php if(!empty($success)){
    if($success == true){ ?>
    <h3> Chỉnh sửa thành công!</h3>
    <?php  }else{ ?>
    <h3> Chỉnh sửa thất bại!</h3>
    <?php   }
    }

    ?>

    <form class="form_insert" action="{{route('editing.updating',['model'=>$modelName,'id'=>$item['id']])}}" method="POST" enctype="multipart/form-data">
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
                <input class="@error($field) is-invalid @enderror"  type="text" size="65" name="<?= $config['field'] ?>" value="<?= $item[$config['field']] ?>"  />
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
                <input type="number" class="@error($field) is-invalid @enderror" size="65" name="<?= $config['field'] ?>" value="<?= $item[$config['field']] ?>"/>
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
                <input style="background-color: #FFFFFF" type="file"  size="65" name="<?= $config['field'] ?>"  />
            </div>
        </div>
        <?php     break;
        case 'textarea':
        $field = $config['field']?>
        <div class="insert">
            <label><?= $config['name'] ?>: </label>
            <div >
                <textarea  class="@error($field) is-invalid @enderror" type="text" rows="3" name="<?= $config['field'] ?>" ><?= $item[$config['field']]?></textarea>
            </div>
        </div>
        <?php     break;
        case 'foreign_key':
        $field = $config['field']?>
        <div class="insert">
            <label><?= $config['name']  ?>:  </label>

            <select class="@error($field) is-invalid @enderror" name="<?= $config['field'] ?>" id="<?= $config['field'] ?>">
                <?php
                if(!empty($cates)) {
                foreach ($cates as $cate) {

                  if($cate['id'] == $item[$config['field']] ) {?>
                    <option value="<?= $cate['id'] ?>" selected><?= $cate['name_cate'] ?></option>
              <?php    }else{ ?>
                    <option value="<?= $cate['id'] ?>" ><?= $cate['name_cate'] ?></option>
                  <?php  }
                    ?>


                <?php
                }
                } ?>
            </select>
        </div>
        <?php     break;
        }
        }
        }?>
        <button style="margin-left: 320px; margin-top: 20px; background-color: #FFF; color: #e02c68" class="btn btn-primary" type="submit">Chỉnh sửa</button>
    </form>

@endsection
