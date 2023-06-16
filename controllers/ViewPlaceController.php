<?php

namespace controllers;

use core\Controller;
use models\Excursion;
use models\Exponat;
use models\ViewPlace;
use core\Core;
use models\Worker;

class ViewPlaceController extends Controller
{
        public function operationIndex($params){
            $id = intval($params[0]);
            $viewplace = ViewPlace::getViewPlaceById($id);
            $exponats = Exponat::getExponatsByViewPlace($id);
            return $this->render(null, [
                "exponats"=>$exponats,
                "viewplace"=>$viewplace
            ]);
        }

    public function operationAdd($params){
        $id_excursion = intval($params[0]);
        if(empty($id_excursion)){
            $id_excursion = null;
        }
        $excursions = Excursion::getListExcursions();
        $workers = Worker::getListWorkers();
        if(Core::getInstance()->typeRequest === 'POST'){
            $failures = [];
            if (empty(trim($_POST['name']))){
                $failures["name"] = "Назва виставочної зали не вказана";
            }
            if (empty($_POST['description'])){
                $failures["description"] = "Опис виставочної зали не вказаний";
            }
            if (empty($_POST['id_excursion'])){
                $failures["id_excursion"] = "Екскурсія не вказана";
            }
            if(empty($failures)){
                ViewPlace::addViewPlace($_POST["name"], $_POST["description"], $_POST["id_excursion"], $_POST["id_worker"], $_FILES["file"]['tmp_name']);
                return $this->redirect("/excursion/view/{$id_excursion}");
            }
            else{
                return $this->render(null,["failures"=>$failures,"excursions"=>$excursions, "excursion_id"=>$id_excursion, "workers"=>$workers]);
            }

        }
        return $this->render(null, [
            "excursions"=>$excursions,
            "excursion_id"=>$id_excursion,
            "workers"=>$workers
        ]);
    }

    public function operationEdit($params){
        $id_viewplace = intval($params[0]);
        if(empty($id_viewplace)){
            $id_viewplace = null;
        }
        $excursions = Excursion::getListExcursions();
        $viewplace = ViewPlace::getViewPlaceById($id_viewplace);
        $workers = Worker::getListWorkers();
        $worker_id = Worker::getWorkerById($viewplace["id_worker"]);
        if(Core::getInstance()->typeRequest === 'POST'){
            $failures = [];
            if (empty(trim($_POST['name']))){
                $failures["name"] = "Назва виставочної зали не вказана";
            }
            if (empty($_POST['description'])){
                $failures["description"] = "Опис виставочної зали не вказаний";
            }
            if (empty($_POST['id_excursion'])){
                $failures["id_excursion"] = "Екскурсія не вказана";
            }
            if (!empty($_FILES['file']['tmp_name'])){
               ViewPlace::changeViewPlacePhoto($id_viewplace, $_FILES['file']['tmp_name']);
            }
            if(empty($failures)){
                ViewPlace::updateViewPlace($id_viewplace, $_POST["name"], $_POST["description"], $_POST["id_excursion"], $_POST["id_worker"]);
                return $this->redirect("/excursion/view/{$viewplace["id_excursion"]}");
            }
            else{
                return $this->render(null,["failures"=>$failures,"excursions"=>$excursions, "viewplace"=>$viewplace,"workers"=>$workers, "worker_id"=>$worker_id]);
            }

        }
        return $this->render(null, [
            "excursions"=>$excursions,
            "viewplace"=>$viewplace,
            "workers"=>$workers,
            "worker_id"=>$worker_id
        ]);
    }

    public function operationDelete($params){
        $id_viewplace = intval($params[0]);
        $consent = boolval($params[1] === 'yes');
        if(empty($id_viewplace)){
            $id_viewplace = null;
        }
        if ($id_viewplace>0){
            $viewplace = ViewPlace::getViewPlaceById($id_viewplace);
            if($consent){
                $photoPath = "images/viewplace/".$viewplace["Photo"];
                if(is_file($photoPath)){
                    unlink($photoPath);
                }
                ViewPlace::deleteViewPlace($id_viewplace);
                return $this->redirect("/excursion/view/{$viewplace['id_excursion']}");

            }
            return $this->render(null, [ "viewplace"=>$viewplace]);
        }
        else{
            return $this->error(403);
        }

    }
}