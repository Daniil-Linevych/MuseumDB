<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Excursion;
use models\User;

class UserController extends Controller
{
    protected $visitorAccess = 2;

    public function operationRegistration()
    {
        if (Core::getInstance()->typeRequest === 'POST') {
            $validation_array = [];
            if (empty($_POST['login'])){
                $validation_array['login'][] = 'Логін не може бути пустим';
            }
            else if (!Core::getInstance()->db->getUser($_POST['login'])){
                $validation_array['login'][] = 'Такий користувач вже існує';
                $input_values['login'] = $_POST['login'];
            }
            if (strlen($_POST['password'])<6 || strlen($_POST['password'])>20){
                $validation_array['password'] = 'Пароль повинен містити 6-20 символів';
            }
            if ($_POST['password'] != $_POST['repeat_password']){
                $validation_array['repeat_password'] = 'Паролі не співпадають';
            }
            if(empty($_POST['fName'])){
                $validation_array['fName'] = 'Ім\'я не може бути пустим';
            }
            if(empty($_POST['lName'])){
                $validation_array['lName'] = 'Прізвище не може бути пустим';
            }
            if (!(preg_match("/^\+\d{1,2}\d{3}[\s-]?\d{3}[\s-]?\d{4}$/i",$_POST['phone']))){
                $validation_array['phone'] = 'Некоректний номер телефону';
                $input_values['phone'] = $_POST['phone'];
            }
            if (count($validation_array)>0){
                return $this->render(null, ['validation_array'=>$validation_array, 'input_values'=>$input_values]);
            }
            else{
                User::addUser($_POST['login'],$_POST['password'],$_POST['fName'],$_POST['lName'], $this->visitorAccess,$_POST['phone']);
                return $this->redirect("/user/authorization");
            }

        } else
            return $this->render();

    }

    public function operationAuthorization(){
        if(User::isAuthenticate()){
            $this->redirect("/");
        }
        $failure = null;
        if (Core::getInstance()->typeRequest === 'POST') {
            $user = User::getUserByPasswordAndLogin($_POST['login'], $_POST['password']);
            if (empty($user)) {
                $failure = "Неправильно введено логін або пароль";
            }
            else{
                User::authenticate($user);
                $this->redirect("/main/index");
            }
            return $this->render(null, ['failure' => $failure]);

        }
        else return $this->render();

    }

    public function operationLogout(){
        User::disauthenticate();
        $this->redirect("/user/authorization");

    }

    public function operationExit(){
        User::endExcursion();
        $this->redirect("/excursion/index");
    }
}