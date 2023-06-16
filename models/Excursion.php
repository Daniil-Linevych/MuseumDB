<?php

namespace models;

use core\Core;

class Excursion
{

    public static function getListExcursions(){
        return Core::getInstance()->db->SELECT("Excursion");
    }

    public static function getExcursionById($id){
        $excursion = Core::getInstance()->db->SELECT("Excursion","*",["id"=>$id]);
        if (!empty($excursion)){
            return $excursion[0];
        }
        else{
            return null;
        }
    }

    public static function addExcursion($name, $description,$isWithGuide, $price){
        Core::getInstance()->db->INSERT("Excursion", ["Name"=>$name, "Description"=>$description,"IsWithGuide"=>$isWithGuide, "Price"=>$price]);
    }

    public static function deleteExcursion($id){
        Core::getInstance()->db->DELETE("Excursion", ["id"=>$id]);
    }

    public static function updateExcursion($id, $name, $description, $isWithGuide, $price){
        Core::getInstance()->db->UPDATE("Excursion", ["Name"=>$name,"Description"=>$description,"IsWithGuide"=>$isWithGuide, "Price"=>$price], ["id"=>$id]);
    }




}