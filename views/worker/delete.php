<?php
/** @var array $worker */
use core\Core;

?>
<div class="alert alert-warning" role="alert">
    <h4 class="alert-heading">Ви точно хочете звільнити <?=$worker["FirstName"]." ".$worker["LastName"]?>?</h4>
     <hr>
    <p class="mb-0"><a href="/worker/delete/<?=$worker["Login"]?>/yes" class="btn btn-danger">Звільнити</a>
        <a href="/worker/index" class="btn btn-secondary">Скасувати</a></p>
</div>
