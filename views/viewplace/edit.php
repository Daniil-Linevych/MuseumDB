<?php
/** @var array $failures */
/** @var array $excursions */
/** @var array $workers */
/** @var int|null $worker_id */
/** @var array $viewplace */
/** @var int|null $excursion_id */
core\Core::getInstance()->pageParams['title']='Зміна виставочної зали'
?>
<h1 class="text-center">Зміна виставкової зали: </h1>
<form class="form-style w-50 h-100 mx-auto p-3 my-3" action="" method="post" enctype="multipart/form-data">
    <div class="row g-3 align-items-center mb-2">
        <div class="col-2">
            <label class="col-form-label fw-bold">Назва:</label>
        </div>
        <div class="col-5">
            <input type="text"  class="form-control"  name="name" placeholder="Введіть назву" value="<?=$viewplace["Name"]?>">
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
            <input type="text"  class="form-control"  name="description" placeholder="Введіть опис" value="<?=$viewplace["Description"]?>">
        </div>
        <div class="col-auto">
    <span  class="form-text text-danger">
      <?php if(!empty($failures['description'])) echo $failures['description']; ?>
    </span>
        </div>
    </div>
    <div class="row g-3 align-items-center mb-2">
        <div class="col-2">
            <label class="col-form-label fw-bold">ID Екскурсії:</label>
        </div>
        <div class="col-5">
            <select id="category_id" name="id_excursion">
                <?foreach ($excursions as $excursion):?>
                    <option <?if($excursion["id"] == $viewplace["id_excursion"]) echo 'selected'?>  value="<?=$excursion['id']?>"><?=$excursion['Name']?></option>
                <?endforeach;?>
            </select>
        </div>
        <div class="col-auto">
    <span  class="form-text text-danger">
     <?php if(!empty($failures['id_excursion'])) echo $failures['id_excursion'];?>
    </span>
        </div>
    </div>
    <div class="row g-3 align-items-center mb-2">
        <div class="col-2">
            <label class="col-form-label fw-bold">ID Працівника:</label>
        </div>
        <div class="col-5">
            <select id="category_id" name="id_worker">
                <?foreach ($workers as $worker):?>
                    <option <?if($worker["id"]==$worker_id["id"]) echo 'selected';?> value="<?=$worker['id']?>"><?=$worker['FirstName']." ".$worker['LastName']?></option>
                <?endforeach;?>
            </select>
        </div>
        <div class="col-auto">
    <span  class="form-text text-danger">
     <?php if(!empty($failures['id_worker'])) echo $failures['id_worker'];?>
    </span>
        </div>
    </div>
    <div class="row g-3 align-items-center mb-2">
        <div class="col-2">
            <label class="col-form-label fw-bold">Зображення:</label>
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
    <input class="btn btn-primary mt-3 " type="submit" value="Змінити">
    <a href="/excursion/view/<?=$excursion_id?>" class="btn btn-secondary mt-3 mx-2">Скасувати</a>
</form>

