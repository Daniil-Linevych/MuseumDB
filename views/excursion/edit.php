<?php
/** @var array $excursion */
/** @var array $model */
/** @var array $failures */
core\Core::getInstance()->pageParams['title']='Зміна екскурсії'
?>
<h1 class="text-center">Зміна екскурсії: </h1>
<form class="form-style w-50 h-100 mx-auto p-3 my-3" action="" method="post">
    <div class="row g-3 align-items-center mb-2">
        <div class="col-2">
            <label class="col-form-label fw-bold">Назва:</label>
        </div>
        <div class="col-5">
            <input type="text"  class="form-control"  name="name" placeholder="Введіть назву" value="<?=$excursion["Name"]?>">
        </div>
        <div class="col-auto">
    <span  class="form-text text-danger">
      <?php if(!empty($failures['name'])) echo $failures['name']; ?>
    </span>
        </div>
    </div>
    <div class="row g-3 align-items-center mb-2">
        <div class="col-2">
            <label class="col-form-label fw-bold">Опис:</label>
        </div>
        <div class="col-5">
            <input type="text"  class="form-control" name="description"   placeholder="Введіть опис" value="<?=$excursion["Description"]?>">
        </div>
        <div class="col-auto">
    <span  class="form-text text-danger">
      <?php if(!empty($failures['description'])) echo $failures['description']; ?>
    </span>
        </div>
    </div>
    <div class="row g-3 align-items-center mb-2">
        <div class="col-2">
            <label for="inputPassword6" class="col-form-label fw-bold">Гід:</label>
        </div>
        <div class="col-5">
            <input type="checkbox" id="inputPassword6" name="gid" <?php if($excursion["IsWithGuide"]==1) echo "checked"?>>
        </div>
        <div class="col-auto">
    <span  class="form-text text-danger">
     <?php if(!empty($failures['gid'])) echo $failures['gid'];?>
    </span>
        </div>
    </div>
    <div class="row g-3 align-items-center mb-2">
        <div class="col-2">
            <label for="inputPassword6" class="col-form-label fw-bold">Ціна:</label>
        </div>
        <div class="col-5">
            <input type="number" id="inputPassword6" class="form-control" name="price" placeholder="Введіть ціну:" value="<?=$excursion["Price"]?>">
        </div>
        <div class="col-auto">
    <span  class="form-text text-danger">
      <?php if(!empty($failures['price'])) echo $failures['price'];?>
    </span>
        </div>
    </div>
    <input class="btn btn-primary mt-3" type="submit" value="Змінити">
    <a href="/excursion/index" class="btn btn-secondary mt-3">Скасувати</a>
</form>

