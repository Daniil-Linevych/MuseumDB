<?php
/** @var array $failures */
/** @var array $user */
/** @var array $excursion*/
core\Core::getInstance()->pageParams['title']='Оплата'
?>
<h1 class="text-center">Оплата екскурсії "<?=$excursion["Name"]?>" :</h1>
<a class="btn btn-primary mb-2" href="/excursion/index">Повернутись</a>
<form class="form-style w-50 h-100 mx-auto p-3 my-3" action="" method="post">
    <div class="row g-3 align-items-center mb-2">
        <div class="col-2">
            <label class="col-form-label">Ім'я:</label>
        </div>
        <div class="col-5">
            <input type="text"  class="form-control"  name="name" value="<?=$user["FirstName"]." ".$user["LastName"]?>">
        </div>
        <div class="col-auto">
    <span  class="form-text text-danger">
      <?php if(!empty($failures['name'])) echo $failures['name']; ?>
    </span>
        </div>
    </div>
    <div class="row g-3 align-items-center mb-2">
        <div class="col-2">
            <label class="col-form-label">Номер картки:</label>
        </div>
        <div class="col-5">
            <input type="number"  class="form-control"  name="card" value="1111111111111111">
        </div>
        <div class="col-auto">
    <span  class="form-text text-danger">
      <?php if(!empty($failures['card'])) echo $failures['card']; ?>
    </span>
        </div>
    </div>
    <div class="row g-3 align-items-center mb-2">
        <div class="col-2">
            <label for="inputPassword6" class="col-form-label">День закінчення терміну:</label>
        </div>
        <div class="col-5">
            <input type="text"  name="date" value="01/2024">
        </div>
        <div class="col-auto">
    <span  class="form-text text-danger">
     <?php if(!empty($failures['date'])) echo $failures['date'];?>
    </span>
        </div>
    </div>
    <div class="row g-3 align-items-center mb-2">
        <div class="col-2">
            <label for="inputPassword6" class="col-form-label">Код:</label>
        </div>
        <div class="col-5">
            <input type="number"  class="form-control" name="code" value="111">
        </div>
        <div class="col-auto">
    <span  class="form-text text-danger">
      <?php if(!empty($failures['code'])) echo $failures['code'];?>
    </span>
        </div>
    </div>
    <input class="btn btn-primary mt-3" type="submit" value="Сплатити">
</form>