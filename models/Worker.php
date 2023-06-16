<?php

namespace models;

use core\Core;
use models\User;

class Worker
{
    private static $workerPassword = '111111';
    private static $workerAccess = 1;
    private static $workerLogin = "Worker";

    public static function getListWorkers(){
        return Core::getInstance()->db->SELECT("Worker");

    }

    public static function createLogin(){
        return self::$workerLogin.rand(100,999);
    }

    public static function addWorker($fName, $lName, $dateOfBirth, $address, $phone){
        $login = self::createLogin();
        \core\Core::getInstance()->db->INSERT("Worker", ['Login'=>$login, 'FirstName'=>$fName, 'LastName'=>$lName, "DateOfBirth"=>$dateOfBirth, "Address"=>$address, 'Phone'=>$phone]);
        User::addUser($login, self::$workerPassword, $fName, $lName, self::$workerAccess, $phone);

    }
    public static function updateWorker($login, $fName, $lName, $dateOfBirth, $address, $access, $phone){
        \core\Core::getInstance()->db->UPDATE("Worker", [ 'FirstName'=>$fName, 'LastName'=>$lName, "DateOfBirth"=>$dateOfBirth, "Address"=>$address, 'Phone'=>$phone], ["Login"=>$login]);
        User::updateUser(["Login"=>$login], $fName, $lName, $access, $phone);
    }

    public static function deleteWorker($login){
        \core\Core::getInstance()->db->DELETE("Worker", ["Login"=>$login]);
        User::deleteUser(["Login"=>$login]);
    }

    public  static  function getWorkerByLogin($login){
        $worker =  \core\Core::getInstance()->db->SELECT("Worker", "*", ["Login"=>$login]);;
        if (!empty($worker)){
            return $worker[0];
        }
        else{
            return null;
        }
    }

    public  static  function getWorkerById($id){
        $worker =  \core\Core::getInstance()->db->SELECT("Worker", "*", ["id"=>$id]);;
        if (!empty($worker)){
            return $worker[0];
        }
        else{
            return null;
        }

    }
}