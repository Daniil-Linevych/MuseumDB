<?php
/** @var string $title */
/** @var string $Content */

/** @var string $siteName */

use \models\User;

if (User::isAuthenticate())
    $user = User::getAuthenticateUser();
else
    $user = null;

if(User::isOnExcursion())
    $excursion = User::getCurrentExcursion();
else
    $excursion = null;


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $siteName ?> | <?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="themes\light\css\style.css" rel="stylesheet">

</head>
<body style="height: 100vh !important; background-color: #edd1b0!important;" class="container-fluid p-0 min-vh-100">
<header class=" p-4 mb-3 bg-dark text-white-50">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/"
               class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none text-white">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                    <use xlink:href="#bootstrap"></use>
                </svg>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <? if (User::isOnExcursion()): ?>
                    <li><a href="/viewplace/index" class="nav-link px-2 text-light fs-2">Екскурсія - <?=$excursion["Name"]?>!</a></li>
                <? else : ?>
                <li><a href="/main/index" class="nav-link px-2 text-light">Головна сторінка</a></li>
                <li><a href="/excursion/index" class="nav-link px-2 text-light">Екскурсії</a></li>
                <? if (User::isAuthenticate() && User::isUserAdmin()):?>
                    <li><a href="/worker/index" class="nav-link px-2 text-light">Працівники</a></li>
                        <li><a href="/statistic/index" class="nav-link px-2 text-light">Статистики</a></li>
                        <li><a href="/main/backup" class="nav-link px-2 text-light">Бекап</a></li>
                        <li><a href="/main/restore" class="nav-link px-2 text-light">Відновлення</a></li>
                    <? endif; ?>
                <li><a href="#" class="nav-link px-2  text-light">Зв'язатись з нами</a></li>
                <li><a href="#" class="nav-link px-2 text-light">Про нас</a></li>
                <? endif; ?>
            </ul>


            <div class="text-end">
                <?php
                if (User::isAuthenticate()) :?>
                    <div class="fw-medium text-wrap"><?= $user["Login"] ?></div>
                    <? if (User::isOnExcursion()):?>
                        <a class="btn btn-primary m-1" href="/user/exit">Exit</a>
                    <? else:?>
                        <a class="btn btn-primary m-1" href="/user/logout">Sign out</a>
                    <?endif; ?>
                <?php
                else:
                    ?>
                    <a href="/user/authorization" class="btn btn-light text-bg-success ">Авторизація</a>
                    <a href="/user/registration" class="btn btn-primary">Реєстрація</a>
                <?php
                endif
                ?>
            </div>
        </div>
</header>
<main style="min-height: 70vh!important;">
    <?= $Content ?>
</main>
<footer class=" py-3 my-4 bg-dark text-white">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        <li class="nav-item"><a href="#" class="nav-link px-2 text-light">Home</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-light">Features</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-light">Pricing</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-light">FAQs</a></li>
    </ul>
    <p class="text-center text-light">© 2023 Company, Inc</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>
</html>