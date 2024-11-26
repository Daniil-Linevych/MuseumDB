<?php
 /** @var array $excursions */
/** @var array $viewplaces*/
$arrayOfNumbers = ["One","Two","Three","Four","Five", "Six"];

use models\User;
use models\Excursion;
?>
<?if(User::isAuthenticate() && User::isUserAdmin()):?>
    <a href="/excursion/add" class="btn btn-info mb-3">Створити</a>
<?endif;?>
<div class="accordion" id="accordionPanelsStayOpenExample">
    <?$i = 0; foreach ($excursions as $excursion) :?>
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse<?=$arrayOfNumbers[$i]?>" aria-expanded="true" aria-controls="panelsStayOpen-collapse<?=$arrayOfNumbers[$i]?>">
                Екскурсія: <?=$excursion["Name"]?>
            </button>
        </h2>
        <div id="panelsStayOpen-collapse<?=$arrayOfNumbers[$i++]?>" class="accordion-collapse collapse">
            <div class="accordion-body">
                    <div >
                        <p><?=$excursion["Description"]?>
                            </p>
                    </div>
                    <div >
                        <p><b>Гід:</b> <input type="checkbox" <? if ($excursion["IsWithGuide"] == 1) echo "checked";?> onclick="return false" ></p></div>
                     <div >

                    <p><b>Ціна:</b> <?=$excursion["Price"]."грн"?></p>
                     </div>
                    <div >
                        <?if(User::isAuthenticate()):?>
                        <?if(User::isUserAdmin()):?>
                        <a href="/excursion/edit/<?=$excursion["id"]?>" class="btn btn-warning">Змінити</a>
                        <a href="/excursion/delete/<?=$excursion["id"]?>" class="btn btn-danger">Видалити</a>
                        <?endif;?>
                        <?if(User::isAuthenticate() && (User::isUserAdmin() || User::isUserWorker())):?>
                                <a href="/excursion/view/<?=$excursion["id"]?>" class="btn btn-success">Почати</a>
                        <?else:?>
                        <a href="/excursion/payment/<?=$excursion["id"]?>" class="btn btn-success">Почати</a>
                            <?endif;?>
                        <?endif;?>
                    </div>

            </div>
        </div>
    </div>
    <?endforeach;?>
</div>