<?php
/** @var array $failures */
/** @var array $viewplaces */
/** @var int|null $viewplace_id */
core\Core::getInstance()->pageParams['title']='Додавання експонату'
?>
<h1 class="text-center">Додавання експонату: </h1>
<form class="form-style w-50 h-100 mx-auto p-3 my-3" action="" method="post" enctype="multipart/form-data">
    <div class="row g-3 align-items-center mb-2">
        <div class="col-2">
            <label class="col-form-label">Назва:</label>
        </div>
        <div class="col-5">
            <input type="text"  class="form-control"  name="name" placeholder="Введіть назву">
        </div>
        <div class="col-auto">
    <span  class="form-text text-danger">
      <?php if(!empty($failures['name'])) echo $failures['name']; ?>
    </span>
        </div>
    </div>
    <div class="row g-3 align-items-center mb-2">
        <div class="col-2">
            <label class="col-form-label">Опис:</label>
        </div>
        <div class="col-5">
            <input type="text"  class="form-control"  name="description" placeholder="Введіть опис">
        </div>
        <div class="col-auto">
    <span  class="form-text text-danger">
      <?php if(!empty($failures['description'])) echo $failures['description']; ?>
    </span>
        </div>
    </div>
    <div class="row g-3 align-items-center mb-2">
        <div class="col-2">
            <label class="col-form-label">Ціна:</label>
        </div>
        <div class="col-5">
            <input type="text"  class="form-control"  name="price" placeholder="Введіть ціну">
        </div>
        <div class="col-auto">
    <span  class="form-text text-danger">
      <?php if(!empty($failures['price'])) echo $failures['price']; ?>
    </span>
        </div>
    </div>
    <div class="row g-3 align-items-center mb-2">
        <div class="col-2">
            <label class="col-form-label">Кількість:</label>
        </div>
        <div class="col-5">
            <input type="text"  class="form-control"  name="count" placeholder="Введіть кількість">
        </div>
        <div class="col-auto">
    <span  class="form-text text-danger">
      <?php if(!empty($failures['count'])) echo $failures['count']; ?>
    </span>
        </div>
    </div>
    <div class="row g-3 align-items-center mb-2">
        <div class="col-2">
            <label class="col-form-label">ID Виставочної зали:</label>
        </div>
        <div class="col-5">
            <select id="category_id" name="id_viewplace">
                <?foreach ($viewplaces as $viewplace):?>
                    <option <?if($viewplace["id"] == $viewplace_id) echo 'selected'?>  value="<?=$viewplace['id']?>"><?=$viewplace['Name']?></option>
                <?endforeach;?>
            </select>
        </div>
        <div class="col-auto">
    <span  class="form-text text-danger">
     <?php if(!empty($failures['id_viewplace'])) echo $failures['id_viewplace'];?>
    </span>
        </div>
    </div>
    <div class="row g-3 align-items-center mb-2">
        <div class="col-2">
            <label class="col-form-label">Зображення:</label>
        </div>
        <div class="col-5">
            <input type="file"  class="form-control" id="file" name="file" lang="uk" >
        </div>
        <div class="col-auto">
    <span  class="form-text text-danger">
      <?php if(!empty($failures['file'])) echo $failures['file']; ?>
    </span>
        </div>
    </div>
    <input class="btn btn-primary mt-3" type="submit" value="Додати">
</form>
