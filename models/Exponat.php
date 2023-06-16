<?php

namespace models;

use core\Core;

class Exponat
{
    public static function getListExponats(){
        return Core::getInstance()->db->SELECT("Exponat");

    }

    public static function deletePhoto($id){
        $exponat = self::getExponatById($id);
        $pathToPhoto = "images/exponat/".$exponat["Photo"];
        if(is_file($pathToPhoto))
            unlink($pathToPhoto);
    }

    public static function changeExponatPhoto($id, $photo){
        self::deletePhoto($id);
        do{
            $name = uniqid().".jpg";
            $newPath = "images/exponat/{$name}";
        }while(file_exists($newPath));
        move_uploaded_file($photo, $newPath);
        Core::getInstance()->db->UPDATE("Exponat", [
            "Photo"=>$name
        ],["id"=>$id]);

    }

    public static function addExponat($name,$description, $price, $count, $id_viewplace, $path){
        do{
            $namePhoto = uniqid().".jpg";
            $newPath = "images/exponat/{$namePhoto}";
        }while(file_exists($newPath));
        move_uploaded_file($path, $newPath);
        Core::getInstance()->db->INSERT("Exponat", ["Name"=>$name,"Description"=>$description, "Price"=>$price, "Count"=>$count,"id_viewplace"=>$id_viewplace, "Photo"=>$namePhoto]);
    }

    public static function deleteExponat($id){
        self::deletePhoto($id);
        Core::getInstance()->db->DELETE("Exponat", ["id"=>$id]);
    }

    public static function updateExponat($id, $name, $description, $price, $count,$id_viewplace){
        Core::getInstance()->db->UPDATE("Exponat", ["Name"=>$name,"Description"=>$description, "Price"=>$price, "Count"=>$count, "id_viewplace"=>$id_viewplace], ["id"=>$id]);
    }

    public static function getExponatsByViewPlace($idViewPLace){
        $product = Core::getInstance()->db->SELECT("Exponat",'*',['id_viewplace'=>$idViewPLace]);
        return $product;
    }

    public static function getExponatById($id){
        $exponat =  Core::getInstance()->db->SELECT("Exponat", "*", ["id"=>$id]);
        if (!empty($exponat)){
            return $exponat[0];
        }
        else{
            return null;
        }
    }
}