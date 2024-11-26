<?php

namespace models;

class User
{
    public static function encryptPassword($pass){
        return md5($pass);
    }

    public static function addUser($login, $password, $fName, $lName, $access, $phone){

        \core\Core::getInstance()->db->INSERT("user", ['Login'=>$login, 'Password'=>self::encryptPassword($password), 'FirstName'=>$fName, 'LastName'=>$lName, 'Access'=>$access, 'Phone'=>$phone]);

    }
    public static function updateUser($condition, $fName, $lName, $access, $phone){
        \core\Core::getInstance()->db->UPDATE("user", ['FirstName'=>$fName, 'LastName'=>$lName, 'Access'=>$access, 'Phone'=>$phone], $condition);

    }

    public static function deleteUser($condition){
        \core\Core::getInstance()->db->DELETE("user",  $condition);

    }

    public static function authenticate($user){
        $_SESSION['user'] = $user;
    }

    public static function disauthenticate(){
        unset($_SESSION['user']);
    }

    public static function isAuthenticate(){
        return isset($_SESSION['user']);
    }
    public static function getAuthenticateUser(){
        return $_SESSION['user'];
    }
    public  static  function getUserByPasswordAndLogin($login, $password){
        $user =  \core\Core::getInstance()->db->SELECT("user", "*", ["login"=>$login, "password"=>self::encryptPassword($password)]);;
        if (!empty($user)){
            return $user[0];
        }
        else{
            return null;

        }

    }
    public static function isUserAdmin(){
        $user = self::getAuthenticateUser();
        return $user["Access"] == 0;
    }
    public static function isUserWorker(){
        $user = self::getAuthenticateUser();
        return $user["Access"] == 1;
    }
    public static function isUserVisitor(){
        $user = self::getAuthenticateUser();
        return $user["Access"] == 2;
    }

    public static function startExcursion($excursion){
        $_SESSION["excursions"] = $excursion;
    }

    public static function endExcursion(){
        unset($_SESSION["excursions"]);
    }

    public static function isOnExcursion(){
        return isset($_SESSION["excursions"]) ;
    }

    public static function getCurrentExcursion(){
        return $_SESSION['excursions'];
    }




}