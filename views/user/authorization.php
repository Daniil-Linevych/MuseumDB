<?php
/** @var string $failure */
core\Core::getInstance()->pageParams['title']='Авторизація'
?>
<h1 class="text-center">Авторизація</h1>
<form class="form-style w-50 h-100 mx-auto p-3 my-3" action="" method="post">
    <?php if (!empty($failure)) :
        ?>
        <div class="row g-3 align-items-center m-2 alert alert-danger"><?=$failure?></div>
    <?php endif; ?>
    <div class="row g-3 align-items-center mb-2">
        <div class="col-2">
            <label class="col-form-label">Логін:</label>
        </div>
        <div class="col-10">
            <input type="text"  class="form-control" name="login" placeholder="Введіть логін">
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
        <div class="col-10">
            <input type="password" id="inputPassword6" class="form-control" name="password" placeholder="Введіть пароль">
        </div>
        <div class="col-auto">
    <span  class="form-text text-danger">
     <?php if(!empty($validation_array['password'])) echo $validation_array['password'];?>
    </span>
        </div>
    </div>
    <input class="btn btn-primary mt-3" type="submit" value="Авторизуватися">
</form>
