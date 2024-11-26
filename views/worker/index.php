<?php
/** @var array $workers */
/** @var array $viewplaces */
$arrayOfNumbers = ["One","Two","Three","Four","Five", "Six", "Seven"];

use models\User;
use models\Excursion;
?>
<?if(User::isUserAdmin()):?>
    <a href="/worker/add" class="btn btn-info mb-3">Найняти</a>
<?endif;?>
<div class="accordion" id="accordionPanelsStayOpenExample">
    <?$i = 0; foreach ($workers as $worker) :?>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse<?=$arrayOfNumbers[$i]?>" aria-expanded="true" aria-controls="panelsStayOpen-collapse<?=$arrayOfNumbers[$i]?>">
                    <?=$worker["Login"]?>
                </button>
            </h2>
            <div id="panelsStayOpen-collapse<?=$arrayOfNumbers[$i++]?>" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <div >
                        <p><b><?=$worker["FirstName"]." ".$worker["LastName"]?></b>
                        </p>
                    </div>
                    <div >
                        <p>Дата народження: <?=$worker["DateOfBirth"]?></p></div>
                    <div >
                        <p>Адреса: <?=$worker["Address"]?></p>
                    </div>
                    <div >
                        <p>Номер телефону: <?=$worker["Phone"]?></p>
                    </div>
                    <?php $arrayOfviewplaces = [];
                    foreach($viewplaces as $viewplace)
                    {if($worker["id"] == $viewplace["id_worker"] )
                        $arrayOfViewplaces[] = $viewplace["Name"];
                    }
                    if (empty($arrayOfViewplaces)):
                    ?>
                    <div >
                        <p>Не відповідає за жодну виставкову залу </p>
                    </div>
                    <?else:?>
                    <div >
                        <p>Виставкові зали за які відповідає: <?echo implode(", ",$arrayOfViewplaces)?></p>
                    </div>
                    <? $arrayOfViewplaces = array(); endif;?>
                    <div >
                        <?if(User::isUserAdmin()):?>
                            <a href="/worker/edit/<?=$worker["Login"]?>" class="btn btn-warning">Змінити</a>
                            <a href="/worker/delete/<?=$worker["Login"]?>" class="btn btn-danger">Звільнити</a>
                        <?endif;?>
                    </div>

                </div>
            </div>
        </div>
    <?endforeach;?>
</div>