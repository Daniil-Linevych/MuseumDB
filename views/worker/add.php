<?php
/** @var array $failures */
core\Core::getInstance()->pageParams['title'] = 'Наймання працівника'
?>
<h1 class="text-center">Наймання працівника</h1>
<form class="form-style w-50 h-100 mx-auto p-3 my-3" action="" method="post">

    <div class="row g-3 align-items-center mb-2">
        <div class="col-2">
            <label class="col-form-label">Ім'я</label>
        </div>
        <div class="col-5">
            <input type="text" class="form-control" name="fName" placeholder="Введіть ім'я">
        </div>
        <div class="col-auto">
    <span class="form-text text-danger">
      <?php if (!empty($failures['fName'])) echo $failures['fName']; ?>
    </span>
        </div>
    </div>
    <div class="row g-3 align-items-center mb-2">
        <div class="col-2">
            <label for="inputPassword6" class="col-form-label">Прізвище</label>
        </div>
        <div class="col-5">
            <input type="text" id="inputPassword6" class="form-control" name="lName" placeholder="Введіть прізвище">
        </div>
        <div class="col-auto">
    <span class="form-text text-danger">
      <?php if (!empty($failures['lName'])) echo $failures['lName']; ?>
    </span>
        </div>
    </div>
    <div class="row g-3 align-items-center mb-2">
        <div class="col-2">
            <label class="col-form-label">Дата народження:</label>
        </div>
        <div class="col-5">
            <input type="date" class="form-control" name="dateOfBirth">
        </div>
        <div class="col-auto">
    <span class="form-text text-danger">
      <?php if (!empty($failures['dateOfBirth'])) echo $failures['dateOfBirth']; ?>
    </span>
        </div>
        <div class="row g-3 align-items-center mb-2">
            <div class="col-2">
                <label class="col-form-label">Адреса:</label>
            </div>
            <div class="col-5">
                <input type="text" class="form-control" name="address" placeholder="Введіть адресу">
            </div>
            <div class="col-auto">
    <span class="form-text text-danger">
      <?php if (!empty($failures['address'])) echo $failures['address']; ?>
    </span>
            </div>
            <div class="row g-3 align-items-center mb-2">
                <div class="col-2">
                    <label class="col-form-label">Телефон</label>
                </div>
                <div class="col-5">
                    <input type="text" class="form-control" name="phone" placeholder="Введіть номер телефону">
                </div>
                <div class="col-auto">
    <span class="form-text text-danger mt-2">
      <?php if (!empty($failures['phone'])) echo $failures['phone']; ?>
    </span>
                </div>
            </div>
            <input class="btn btn-primary mt-3 w-25" type="submit" value="Найняти">
</form>
