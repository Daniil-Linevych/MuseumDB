<?php
/**
 * @var array $viewplaces
 */
/** @var array $excursion */

use models\User;
use models\Worker;

if(User::isUserWorker()){
    $worker = User::getAuthenticateUser();
    $worker = Worker::getWorkerByLogin($worker["Login"]);
}
?>
<h3>Виставкові зали</h3>
<?php
if (User::isUserAdmin()) :
    ?>
    <a href="/viewplace/add/<?=$excursion["id"]?>" class="btn btn-info mb-3">Створити</a>
<?php endif; ?>

<div class="row row-cols-1 row-cols-md-2 g-4">
    <?php foreach ($viewplaces as $viewplace): ?>
    <div class="col">
        <div class="card h-100 w-75">
            <? $photoPath = "images/viewplace/".$viewplace["Photo"];
            if(is_file($photoPath)) :?>
                <img src="/<?=$photoPath?>" class="card-img-top mw-50 mh-50" alt="...">
            <?else: ?>
                <img src="/images/static/No_Image_Available.jpg" class="card-img-top w-100" " alt="...">
            <?endif; ?>
            <div class="card-body">
                <h5 class="card-title"><?=$viewplace["Name"]?></h5>
                <p class="card-text"><?=$viewplace["Description"]?></p>
                <?php
                if (User::isUserAdmin() || (User::isUserWorker() && $worker["id"] == $viewplace["id_worker"])) :
                    ?>
                    <a href="/viewplace/edit/<?=$viewplace['id']?>" class="btn btn-warning">Змінити</a>
                    <a href="/viewplace/delete/<?=$viewplace['id']?>" class="btn btn-danger">Видалити</a>
                <?php endif; ?>
                <a href="/viewplace/index/<?=$viewplace["id"]?>" class="btn btn-success">Перейти</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
