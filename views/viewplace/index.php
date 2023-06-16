<?php
/**
 * @var array $exponats
 */
/**
 * @var array $viewplace
 */

use models\User;

use models\Worker;

if(User::isUserWorker()){
    $worker = User::getAuthenticateUser();
    $worker = Worker::getWorkerByLogin($worker["Login"]);
}
?>
<h3>Експонати:</h3>
<?php
if (User::isUserAdmin()) :
    ?>
    <a href="/exponat/add/<?=$viewplace["id"]?>" class="btn btn-info mb-3">Створити</a>
<?php endif; ?>
<a href="/excursion/view/<?=$viewplace["id_excursion"]?>" class="btn btn-primary mb-3">Повернутись</a>

<div class="row row-cols-1 row-cols-md-4 g-4">
    <?php foreach ($exponats as $exponat): ?>
    <div class="col">
        <div class="card h-100">
            <? $photoPath = "images/exponat/".$exponat["Photo"];
            if(is_file($photoPath)) :?>
                <img src="/<?=$photoPath?>" class="card-img-top" alt="...">
            <?else: ?>
                <img src="/images/static/No_Image_Available.jpg" class="card-img-top" alt="...">
            <?endif; ?>
            <div class="card-body">
                <h5 class="card-title"><?= $exponat["Name"]; ?></h5>
            </div>
            <div class="p-2 mx-2">
                <?php
                if (User::isUserAdmin() || (User::isUserWorker() && $worker["id"] == $viewplace["id_worker"])) :
                    ?>
                    <a href="/exponat/edit/<?=$exponat['id']?>" class="btn btn-warning">Змінити</a>
                    <a href="/exponat/delete/<?=$exponat['id']?>" class="btn btn-danger">Видалити</a>
                <?php endif; ?>
                <a href="/exponat/index/<?=$exponat['id']?>" class="btn btn-success">Переглянути</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>