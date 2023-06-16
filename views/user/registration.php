<?php
/** @var array $validation_array */
/** @var array $input_values */
core\Core::getInstance()->pageParams['title']='Реєстрація'
?>
<h1 class="text-center">Реєстрація</h1>
<form class="form-style w-50 h-100 mx-auto p-3 my-3" action="" method="post">
    <div class="row g-3 align-items-center mb-2">
        <div class="col-2">
            <label class="col-form-label">Логін:</label>
        </div>
        <div class="col-5">
            <input type="text"  class="form-control" value="<?=$input_values['login'] ?>" name="login" placeholder="Введіть логін">
        </div>
        <div class="col-auto">
    <span  class="form-text text-danger">
      <?php if(!empty($validation_array['login'][0])) echo $validation_array['login'][0]; else if(!empty($validation_array['login'][1]))echo $validation_array['login'][1];?>
    </span>
        </div>
    </div>
    <div class="row g-3 align-items-center mb-2">
        <div class="col-2">
            <label for="inputPassword6" class="col-form-label">Пароль:</label>
        </div>
        <div class="col-5">
            <input type="password" id="inputPassword6" class="form-control" name="password" placeholder="Введіть пароль">
        </div>
        <div class="col-auto">
    <span  class="form-text text-danger">
     <?php if(!empty($validation_array['password'])) echo $validation_array['password'];?>
    </span>
        </div>
    </div>
    <div class="row g-3 align-items-center mb-2">
        <div class="col-2">
            <label for="inputPassword6" class="col-form-label">Повторіть пароль:</label>
        </div>
        <div class="col-5">
            <input type="password" id="inputPassword6" class="form-control" name="repeat_password" placeholder="Повторіть пароль">
        </div>
        <div class="col-auto">
    <span  class="form-text text-danger">
      <?php if(!empty($validation_array['repeat_password'])) echo $validation_array['repeat_password'];?>
    </span>
        </div>
    </div>
    <div class="row g-3 align-items-center mb-2">
        <div class="col-2">
            <label for="inputPassword6" class="col-form-label">Ім'я</label>
        </div>
        <div class="col-5">
            <input type="text" id="inputPassword6" class="form-control"  name="fName" placeholder="Введіть ім'я"">
        </div>
        <div class="col-auto">
    <span  class="form-text text-danger">
      <?php if(!empty($validation_array['fName'])) echo $validation_array['fName'];?>
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
    <span  class="form-text text-danger">
      <?php if(!empty($validation_array['lName'])) echo $validation_array['lName'];?>
    </span>
        </div>
    </div>
    <div class="row g-3 align-items-center mb-2">
        <div class="col-2">
            <label class="col-form-label">Телефон</label>
        </div>
        <div class="col-5">
            <input type="text" class="form-control" value="<?=$input_values['phone'] ?>" name="phone" placeholder="Введіть номер телефону">
        </div>
        <div class="col-auto">
    <span class="form-text text-danger mt-2">
      <?php if(!empty($validation_array['phone'])) echo $validation_array['phone'];?>
    </span>
        </div>
    </div>
    <input class="btn btn-primary mt-3" type="submit" value="Зареєструватися">
</form>
