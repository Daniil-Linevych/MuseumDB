<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Excursion;
use models\Statistics;
use models\User;
use models\ViewPlace;

class ExcursionController extends Controller
{
    public function operationIndex(){
        $excursions = Excursion::getListExcursions();
        return $this->render(null, ["excursions"=>$excursions]);
    }

    public function operationAdd(){
        if(!User::isUserAdmin()){
            return $this->error(403);
        }
        if (Core::getInstance()->typeRequest == "POST"){
            $failures = [];
            if (empty(trim($_POST['name']))){
                $failures["name"] = "Ім'я екскурсії не вказано";
            }
            if (empty(trim($_POST['description']))){
                $failures["description"] = "Опис екскурсії не вказаний";
            }
            if (empty($_POST['gid'])){
                $_POST["gid"] = 0;
            }
            else $_POST["gid"] = 1;
            if (empty($_POST['price'])){
                $failures["price"] = "Ціна екскурсії не вказана";
            }
            if(empty($failures)){
                Excursion::addExcursion($_POST["name"],$_POST["description"], $_POST["gid"], $_POST["price"]);
                return $this->redirect("/excursion/index");
            }
            else{
                $model = $_POST;
                return $this->render(null,["failures"=>$failures,"model"=>$model]);
            }

        }
        return $this->render();
    }

    public function operationEdit($params){
        if(!User::isUserAdmin()){
            return $this->error(403);
        }
        $id = intval($params[0]);
        $excursion = Excursion::getExcursionById($id);
        if (Core::getInstance()->typeRequest == "POST"){
            $failures = [];
            if (empty(trim($_POST['name']))){
                $failures["name"] = "Ім'я екскурсії не вказано";
            }
            if (empty(trim($_POST['description']))){
                $failures["description"] = "Опис екскурсії не вказаний";
            }
            if (empty($_POST['gid'])){
                $_POST["gid"] = 0;
            }
            else $_POST["gid"] = 1;
            if (empty($_POST['price'])){
                $failures["price"] = "Ціна екскурсії не вказана";
            }
            if(empty($failures)){
                Excursion::updateExcursion($id, $_POST["name"], $_POST["description"], $_POST["gid"], $_POST["price"]);
                return $this->redirect("/excursion/index");
            }
            else{
                $model = $_POST;
                return $this->render(null,["failures"=>$failures,"model"=>$model, "excursion"=>$excursion]);
            }

        }
        return $this->render(null, [
            "excursion"=>$excursion
        ]);
    }

    public function operationDelete($params){
        if(!User::isUserAdmin()){
            return $this->error(403);
        }
        $id = intval($params[0]);
        $consent = boolval($params[1] === 'yes');
        if ($id>0){
            $excursion = Excursion::getExcursionById($id);
            if($consent){
                Excursion::deleteExcursion($id);
                Statistics::deleteExcursionInfo($id);
                return $this->redirect("/excursion/index");

            }
            return $this->render(null, [ "excursion"=>$excursion]);
        }
        else{
            return $this->error(403);
        }
    }

    public function operationView($params){
        $id = intval($params[0]);
        $excursion = Excursion::getExcursionById($id);
        if (User::isUserVisitor())
            Statistics::updateExcursionInfo($id);
        if (empty(User::getCurrentExcursion()))
            User::startExcursion($excursion);
        $viewplaces = ViewPlace::getListViewPlacesByExcursion($excursion["id"]);
        return $this->render(null, ['viewplaces'=>$viewplaces, "excursion"=>$excursion]);

    }

    public function operationPayment($params){
        $id = intval($params[0]);
        $excursion = Excursion::getExcursionById($id);
        $user = User::getAuthenticateUser();
        if (Core::getInstance()->typeRequest == "POST"){
            $failures = [];
            if (empty(trim($_POST['name']))){
                $failures["name"] = "Ім'я коистувача";
            }
            if (empty(trim($_POST['card'])) || $_POST['card'] < 100000000000 || $_POST['card'] > 9999999999999999){
                $failures["card"] = "Номер карти вказаний неправильно";
            }
            if (!(preg_match("/^(0[1-9]|1[0-2])\/(20[1-9][0-9])$/i",$_POST['date']))){
                $failures["date"] = "Дата вказана не правильно";
            }
            if (empty($_POST['code']) || $_POST['code'] < 100 || $_POST['code'] > 999){
                $failures["code"] = "Код вказаний не правильно";
            }
            if(empty($failures)){
                return $this->redirect("/excursion/view/{$id}");
            }
            else{
                return $this->render(null,["failures"=>$failures, "user"=>$user]);
            }

        }
        $excursion = Excursion::getExcursionById($id);
        return $this->render(null, [
            "excursion"=>$excursion,
            "user"=>$user
        ]);

    }




}