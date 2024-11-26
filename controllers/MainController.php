<?php

namespace controllers;

use core\Controller;
use core\Core;

class MainController extends Controller
{
    public function operationIndex() {
        return $this->render();
    }
    public function operationError($code) {
        switch ($code) {
            case 404:
                return $this->render('views/main/error404.php');
                break;
            case 403:
                return $this->render('views/main/error403.php');
                break;
        }
    }

    public function operationBackup(){
        Core::getInstance()->db->BackUp();
        return $this->render();
    }

    public function operationRestore(){
        Core::getInstance()->db->Restore();
        return $this->render();
    }
}