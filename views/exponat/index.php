<?php
/** @var array $exponat */
?>
<h2 class="text-center"><?= $exponat["Name"] ?></h2>
<a class="btn btn-primary mb-2" href="/viewplace/index/<?=$exponat["id_viewplace"]?>">Повернутись</a>
<div class="container m-0">
    <div class="row">
        <div class="col-6">
            <?php $filePath = "images/exponat/" . $exponat["Photo"]; ?>
            <?php if (is_file($filePath)): ?>
                <img src="/<?= $filePath ?>" class="img-thumbnail" alt="...">
            <?php else: ?>
                <img src="/images/static/No_Image_Available.jpg" class="img-thumbnail" alt="...">
            <?php endif; ?>
        </div>
        <div class="col-6">
            <div class="mb-2"><b>Опис:</b> <?=$exponat["Description"]?></div>
            <div class="mb-2"><b>Орієнтована вартість:</b> <?=$exponat["Price"]?> грн</div>
            <div class="mb-2"><b>Кількість:</b> <?=$exponat["Count"]?></div>
        </div>


    </div>
</div>