<?php

namespace controllers;

use core\Controller;
use models\Excursion;
use models\Exponat;
use models\ViewPlace;
use models\Worker;
use models\Statistics;

class StatisticController extends Controller
{

    public function operationIndex($params){
        $cancel = $params[0];
        if(!(empty($cancel))){
            Statistics::unsetExcursionInfo();
        }
        $bestworkers = self::getBestWorkers();
        $excursions = Statistics::getExcursionsInfo();
        $exponats = self::getViewPLaceInfo();
        return $this->render(null, ["workers"=>$bestworkers, "excursions"=>$excursions, "exponats"=>$exponats]);
    }

    public static function getBestWorkers(){
        $workers = Worker::getListWorkers();
        $viewplaces = ViewPlace::getListViewPlaces();
        Statistics::deleteWorkerViewplaces();
        foreach ($workers as $worker) {
            $count = 0;
            foreach ($viewplaces as $viewplace){
                if ($worker["id"] == $viewplace["id_worker"]) {
                    $count++;
                }
            }
            Statistics::insertWorkerViewplaces($worker["id"],$count);

        }
        return Statistics::getWorkers();
    }

    public static function getViewPLaceInfo(){
        $viewplaces = ViewPlace::getListViewPlaces();
        $exponats = Exponat::getListExponats();
        Statistics::deleteViewPlaceExponats();
        foreach ($viewplaces as $viewplace) {
            $count = 0;
            foreach ($exponats as $exponat){
                if ($exponat["id_viewplace"] == $viewplace["id"]) {
                    $count += $exponat["Count"];
                }
            }
            Statistics::insertViewPlaceExponats($viewplace["id"],$count);

        }
        return Statistics::getViewPlaceExponats();
    }

}
