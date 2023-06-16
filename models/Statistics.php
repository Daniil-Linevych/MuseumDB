<?php

namespace models;

use core\Core;

class Statistics
{
    public static function getWorkers(){
        return Core::getInstance()->db->SELECT("Worker", "*", null, ["CountViewplaces"], true, "Worker_viewplaces", ["FirstTable"=>"id", "SecondTable"=>"id_worker"]);
    }

    public static function insertWorkerViewplaces($id, $count){
        Core::getInstance()->db->INSERT("Worker_viewplaces", ["id_worker"=>$id, "CountViewplaces"=>$count]);
    }

    public static function deleteWorkerViewplaces(){
        Core::getInstance()->db->DELETE("Worker_viewplaces");
    }

    public static function insertExcursionInfo($id, $CountEntries){
        Core::getInstance()->db->INSERT("ExcursionInfo", ["id_excursion"=>$id, "CountEntries"=>$CountEntries]);

    }

    public static function deleteExcursionInfo($id){
        Core::getInstance()->db->DELETE("ExcursionInfo", ["id_excursion"=>$id]);

    }

    public static function getExcursionInfoById($id){
        $excursion = Core::getInstance()->db->SELECT("ExcursionInfo", "*", ["id_excursion"=>$id]);;
        if (!empty($excursion)){
            return $excursion[0];
        }
        else{
            return null;

        }

    }

    public static function updateExcursionInfo($id){
        if (!empty(self::getExcursionInfoById($id))){
            $currentCount = self::getExcursionInfoById($id);
            Core::getInstance()->db->UPDATE("ExcursionInfo", ["CountEntries"=>++$currentCount["CountEntries"]], ["id_excursion"=>$id]);
        }
        else{
            self::insertExcursionInfo($id, 1);
        }

    }

    public static function getExcursionsInfo(){
        return Core::getInstance()->db->SELECT("Excursion", "*", null, ["CountEntries"], false, "ExcursionInfo", ["FirstTable"=>"id", "SecondTable"=>"id_excursion"]);

    }

    public static function getViewPlaceExponats(){
        return Core::getInstance()->db->SELECT("ViewPlace", "*", null, null, null, "ViewPlace_exponats", ["FirstTable"=>"id", "SecondTable"=>"id_viewplace"]);
    }

    public static function insertViewPlaceExponats($id, $count){
        Core::getInstance()->db->INSERT("ViewPlace_exponats", ["id_viewplace"=>$id, "CountExponats"=>$count]);
    }

    public static function deleteViewPlaceExponats(){
        Core::getInstance()->db->DELETE("ViewPlace_exponats");
    }

}