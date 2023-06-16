<?php

namespace models;

use core\Core;

class ViewPlace
{

    public static function deletePhoto($id){
        $viewplace = self::getViewPlaceById($id);
        $pathToPhoto = "images/viewplace/".$viewplace["Photo"];
        if(is_file($pathToPhoto))
            unlink($pathToPhoto);
    }

    public static function changeViewPlacePhoto($id, $photo){
        self::deletePhoto($id);
        do{
            $name = uniqid().".jpg";
            $newPath = "images/viewplace/{$name}";
        }while(file_exists($newPath));
        move_uploaded_file($photo, $newPath);
        Core::getInstance()->db->UPDATE("ViewPlace", [
            "Photo"=>$name
        ],["id"=>$id]);

    }

    public static function getListViewPlaces(){
        return Core::getInstance()->db->SELECT("ViewPlace");
    }

    public static function getListViewPlacesByExcursion($id_excursion){
        return Core::getInstance()->db->SELECT("ViewPlace", "*", ["id_excursion"=>$id_excursion]);
    }

    public static function getViewPlaceById($id){
        $viewplace = Core::getInstance()->db->SELECT("ViewPlace","*",["id"=>$id]);
        if (!empty($viewplace)){
            return $viewplace[0];
        }
        else{
            return null;
        }
    }

    public static function addViewPlace($name,$description, $id_excursion, $id_worker, $path){
        do{
            $namePhoto = uniqid().".jpg";
            $newPath = "images/viewplace/{$namePhoto}";
        }while(file_exists($newPath));
        move_uploaded_file($path, $newPath);
        Core::getInstance()->db->INSERT("ViewPlace", ["Name"=>$name,"Description"=>$description, "id_excursion"=>$id_excursion, "id_worker"=>$id_worker, "Photo"=>$namePhoto]);
    }

    public static function deleteViewPlace($id){
        self::deletePhoto($id);
        Core::getInstance()->db->DELETE("ViewPlace", ["id"=>$id]);
    }

    public static function updateViewPlace($id, $name, $description, $id_excursion, $id_worker){
        Core::getInstance()->db->UPDATE("ViewPlace", ["Name"=>$name,"Description"=>$description,"id_excursion"=>$id_excursion, "id_worker"=>$id_worker], ["id"=>$id]);
    }

}