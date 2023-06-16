<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Worker;
use models\ViewPlace;

class WorkerController extends Controller
{
    public function operationIndex(){
        $workers = Worker::getListWorkers();
        return $this->render(null,["workers"=>$workers]);
    }

    public function operationAdd(){
        if (Core::getInstance()->typeRequest === 'POST') {
            $failures = [];
            if(empty($_POST['fName'])){
                $failures['fName'] = 'Ім\'я не може бути пустим';
            }
            if(empty($_POST['lName'])){
                $failures['lName'] = 'Прізвище не може бути пустим';
            }
            if(empty($_POST["dateOfBirth"])){
                $failures['dateOfBirth'] = 'Дата не може бути пустою';
            }
            if(empty($_POST["address"])){
                $failures['address'] = 'Адресв не може бути пустою';
            }
            if (!(preg_match("/^\+\d{1,2}\d{3}[\s-]?\d{3}[\s-]?\d{4}$/i",$_POST['phone']))){
                $failures['phone'] = 'Некоректний номер телефону';
            }
            if (count($failures)>0){
                return $this->render(null, ['failures'=>$failures]);
            }
            else{
                Worker::addWorker($_POST['fName'],$_POST['lName'], $_POST["dateOfBirth"], $_POST["address"],$_POST['phone']);
                return $this->redirect("/worker/index");
            }

        } else{
            return $this->render();
        }

    }

    public function operationEdit($params){
        $login = $params[0];
        $worker = Worker::getWorkerByLogin($login);
        if (Core::getInstance()->typeRequest === 'POST') {
            $failures = [];
            if(empty($_POST['fName'])){
                $failures['fName'] = 'Ім\'я не може бути пустим';
            }
            if(empty($_POST['lName'])){
                $failures['lName'] = 'Прізвище не може бути пустим';
            }
            if(empty($_POST["dateOfBirth"])){
                $failures['dateOfBirth'] = 'Дата не може бути пустою';
            }
            if(empty($_POST["address"])){
                $failures['address'] = 'Адресв не може бути пустою';
            }
            if (!(preg_match("/^\+\d{1,2}\d{3}[\s-]?\d{3}[\s-]?\d{4}$/i",$_POST['phone']))){
                $failures['phone'] = 'Некоректний номер телефону';
            }
            if (count($failures)>0){
                return $this->render(null, ['failures'=>$failures,"worker"=>$worker]);
            }
            else{
                Worker::updateWorker($login,$_POST['fName'],$_POST['lName'], $_POST["dateOfBirth"], $_POST["address"], $_POST["access"],$_POST['phone']);
                return $this->redirect("/worker/index");
            }

        } else{
            return $this->render(null, ["worker"=>$worker]);
        }
    }

    public function operationDelete($params){
        $login = $params[0];
        $consent = boolval($params[1] === 'yes');
        if(empty($login)){
            $login = null;
        }
        if (!empty($login)){
            $worker = Worker::getWorkerByLogin($login);
            if($consent){
                Worker::deleteWorker($login);
                return $this->redirect("/worker/index");

            }
            return $this->render(null, [ "worker"=>$worker]);
        }
        else{
            return $this->error(403);
        }

    }
}