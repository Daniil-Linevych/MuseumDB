<?php
/** @var array $excursion */
use core\Core;

?>
<div class="alert alert-warning" role="alert">
    <h4 class="alert-heading">Ви точно хочете видалити екскурсію ?</h4>
    <p>Після видалення екскурсії всі виставочні зали потраплять до категорії по замовчуванню</p>
    <hr>
    <p class="mb-0"><a href="/excursion/delete/<?=$excursion["id"]?>/yes" class="btn btn-danger">Видалити</a>
        <a href="/excursion/index" class="btn btn-secondary">Скасувати</a></p>
</div>

