<?php
/** @var array $exponat */
use core\Core;

?>
<div class="alert alert-warning" role="alert">
    <h4 class="alert-heading">Ви точно хочете видалити експонат <?=$exponat["Name"]?>?</h4>
    <p>Після видалення видалення експонату його вже не можна буде відновити</p>
    <hr>
    <p class="mb-0"><a href="/exponat/delete/<?=$exponat["id"]?>/yes" class="btn btn-danger">Видалити</a>
        <a href="/viewplace/index/<?=$exponat["id_viewplace"]?>" class="btn btn-secondary">Скасувати</a></p>
</div>

