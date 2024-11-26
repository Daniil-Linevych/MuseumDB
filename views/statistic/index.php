<?php
/** @var array $workers */
/** @var array $excursions */
/** @var array $exponats */
?>

<h2>Статистики:</h2>
<button type="button" class="btn btn-info m-3" data-bs-toggle="modal" data-bs-target="#bestWorker">
    Найкращий працівник
</button>
<button type="button" class="btn btn-info m-3" data-bs-toggle="modal" data-bs-target="#worstExcursion">
    Найнудніша екскурсія
</button>
<button type="button" class="btn btn-info m-3" data-bs-toggle="modal" data-bs-target="#viewplaceExponats">
    Виставкові зали статистика
</button>

<div class="modal fade" id="bestWorker" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Найкращий працівник:</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Ім'я</th>
                        <th scope="col">Прізвище</th>
                        <th scope="col">Кількість виставочних зал</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?$maxCount = 0;
                    foreach ($workers as $worker) : ?>
                        <tr <? if($worker["CountViewplaces"]>=$maxCount) {$maxCount = $worker["CountViewplaces"]; echo 'class="table-success border-3 border-success"';}  ?>>
                            <th scope="row"><?=$worker["id"]?></th>
                            <td><?=$worker["FirstName"]?></td>
                            <td><?=$worker["LastName"]?></td>
                            <td><?=$worker["CountViewplaces"]?></td>
                        </tr>
                    <? endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="worstExcursion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Найнудніша екскурсія:</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Назва</th>
                        <th scope="col">Кількість відвідувань</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?$minCount = $excursions[0]["CountEntries"];
                    foreach ($excursions as $excursion) : ?>
                        <tr <? if($excursion["CountEntries"]<=$minCount) {$minCount = $excursion["CountEntries"]; echo 'class="table-danger border-3 border-danger"';}  ?>>
                            <th scope="row"><?=$excursion["id"]?></th>
                            <td><?=$excursion["Name"]?></td>
                            <td><?=$excursion["CountEntries"]?></td>
                        </tr>
                    <? endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="/statistic/index/cancel" class="btn btn-primary">Скинути</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewplaceExponats" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Кількість експонатів в виставкових залах:</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Назва</th>
                        <th scope="col">Кількість експонатів</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?
                    foreach ($exponats as $exponat) : ?>
                        <tr>
                            <th scope="row"><?=$exponat["id"]?></th>
                            <td><?=$exponat["Name"]?></td>
                            <td><?=$exponat["CountExponats"]?></td>
                        </tr>
                    <? endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

