<?php
/** @var array $viewplace */
use core\Core;

?>
<div class="alert alert-warning" role="alert">
    <h4 class="alert-heading">Ви точно хочете видалити виставкову залу <?=$viewplace["Name"]?>?</h4>
    <p>Після видалення виставочної зали всі її експонати потраплять до виставочної зали по замовчуванню</p>
    <hr>
    <p class="mb-0"><a href="/viewplace/delete/<?=$viewplace["id"]?>/yes" class="btn btn-danger">Видалити</a>
        <a href="/excursion/view/<?=$viewplace["id_excursion"]?>" class="btn btn-secondary">Скасувати</a></p>
</div>

