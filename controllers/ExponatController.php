<?php

namespace controllers;

use core\Controller;
use models\Exponat;
use models\ViewPlace;
use core\Core;

class ExponatController extends Controller
{
    public function operationIndex($params){
        $id = intval($params[0]);
        $exponat = Exponat::getExponatById($id);
        return $this->render(null, ["exponat"=>$exponat]);
    }

    public function operationAdd($params){
        $id_viewplace = intval($params[0]);
        if(empty($id_viewplace)){
            $id_viewplace = null;
        }
        $viewplaces = ViewPlace::getListViewPlaces();
        if(Core::getInstance()->typeRequest === 'POST'){
            $failures = [];
            if (empty(trim($_POST['name']))){
                $failures["name"] = "Назва експонату не вказана";
            }
            if (empty($_POST['description'])){
                $failures["description"] = "Опис експонату зали не вказаний";
            }
            if (empty($_POST['price']) || $_POST["price"]<=0){
                $failures["price"] = "Ціна експонату зали не вказана";
            }
            if (empty($_POST['count']) || $_POST["count"]<=0){
                $failures["count"] = "Кількість експонатів зали не вказана";
            }
            if (empty($_POST['id_viewplace'])){
                $failures["id_viewplace"] = "Виставочна зала не вказана";
            }
            if(empty($failures)){
                Exponat::addExponat($_POST["name"], $_POST["description"],$_POST["price"], $_POST["count"], $_POST["id_viewplace"], $_FILES["file"]['tmp_name']);
                return $this->redirect("/viewplace/index/{$id_viewplace}");
            }
            else{
                return $this->render(null,["failures"=>$failures,"viewplaces"=>$viewplaces, "id_viewplace"=>$id_viewplace]);
            }

        }
        return $this->render(null, [
            "viewplaces"=>$viewplaces,
            "id_viewplace"=>$id_viewplace
        ]);
    }

    public function operationEdit($params){
        $id_exponat = intval($params[0]);
        if(empty($id_exponat)){
            $id_exponat = null;
        }
        $viewplaces = ViewPlace::getListViewPlaces();
        $exponat = Exponat::getExponatById($id_exponat);
        if(Core::getInstance()->typeRequest === 'POST'){
            $failures = [];
            if (empty(trim($_POST['name']))){
                $failures["name"] = "Назва виставочної зали не вказана";
            }
            if (empty($_POST['description'])){
                $failures["description"] = "Опис виставочної зали не вказаний";
            }
            if (empty($_POST['price'])){
                $failures["description"] = "Опис виставочної зали не вказаний";
            }
            if (empty($_POST['price']) || $_POST["price"]<=0){
                $failures["price"] = "Ціна експонату зали не вказана";
            }
            if (empty($_POST['count']) || $_POST["count"]<=0){
                $failures["count"] = "Кількість експонатів зали не вказана";
            }
            if (!empty($_FILES['file']['tmp_name'])){
                Exponat::changeExponatPhoto($id_exponat, $_FILES['file']['tmp_name']);
            }
            if(empty($failures)){
                Exponat::updateExponat($id_exponat, $_POST["name"], $_POST["description"], $_POST["price"], $_POST["count"], $_POST["id_viewplace"]);
                return $this->redirect("/viewplace/index/{$exponat["id_viewplace"]}");
            }
            else{
                return $this->render(null,["failures"=>$failures,"viewplaces"=>$viewplaces, "exponat"=>$exponat ]);
            }

        }
        return $this->render(null, [
            "viewplaces"=>$viewplaces,
            "exponat"=>$exponat
        ]);
    }

    public function operationDelete($params){
        $id_exponat = intval($params[0]);
        $consent = boolval($params[1] === 'yes');
        if(empty($id_exponat)){
            $id_exponat = null;
        }
        if ($id_exponat>0){
            $exponat = Exponat::getExponatById($id_exponat);
            if($consent){
                $photoPath = "images/exponat/".$exponat["Photo"];
                if(is_file($photoPath)){
                    unlink($photoPath);
                }
                Exponat::deleteExponat($id_exponat);
                return $this->redirect("/viewplace/index/{$exponat['id_viewplace']}");

            }
            return $this->render(null, [ "exponat"=>$exponat]);
        }
        else{
            return $this->error(403);
        }

    }
}