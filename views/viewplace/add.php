<?php
/** @var array $failures */
/** @var array $excursions */
/** @var array $workers */
/** @var int|null $excursion_id */
core\Core::getInstance()->pageParams['title']='Додавання виставочної зали'
?>
<h1 class="text-center">Додавання виставкової зали: </h1>
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
            <label class="col-form-label">ID Екскурсії:</label>
        </div>
        <div class="col-5">
            <select id="category_id" name="id_excursion">
                <?foreach ($excursions as $excursion):?>
                    <option <? var_dump($excursion_id); if($excursion["id"] == $excursion_id) echo 'selected'?>  value="<?=$excursion['id']?>"><?=$excursion['id']?></option>
                <?endforeach;?>
            </select>
        </div>
        <div class="col-auto">
    <span  class="form-text text-danger">
     <?php if(!empty($failures['id_excursion'])) echo $failures['id_excursion'];?>
    </span>
        </div>
        <div class="row g-3 align-items-center mb-2">
            <div class="col-2">
                <label class="col-form-label">ID Працівника:</label>
            </div>
            <div class="col-5">
                <select id="category_id" name="id_worker">
                    <?foreach ($workers as $worker):?>
                        <option value="<?=$worker['id']?>"><?=$worker['FirstName']." ".$worker['LastName']?></option>
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
