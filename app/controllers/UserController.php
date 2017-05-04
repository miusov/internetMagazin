<?php

namespace app\controllers;
use app\models\Main;
use app\models\Users;
use R;
use vendor\core\App;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use vendor\core\base\View;

class UserController extends AppController
{
    public function indexAction()
    {
        $model = new Users();
        $user = R::findOne('users', "id={$_SESSION['id']}");

        $this->set(['user'=>$user]);
    }
    public function editAction()
    {
        $model = new Users();

        if (isset($_POST['edit_btn']))
        {
            $us = R::load('users', $_SESSION['id']);
            if (!empty($_POST['newpass'])) $us->pass = trim(password_hash($_POST['newpass'], PASSWORD_DEFAULT));
            if (!empty($_POST['newfam'])) $us->fam = trim($_POST['newfam']);
            if (!empty($_POST['newname'])) $us->name = trim($_POST['newname']);
            if (!empty($_POST['newemail'])) $us->email = trim($_POST['newemail']);
            if (!empty($_POST['newtel'])) $us->tel = trim($_POST['newtel']);
            if (!empty($_POST['newaddress'])) $us->address = trim($_POST['newaddress']);
            R::store($us);

            $res = "<div class='alert-success text-center'>Ваш профиль успешно изменен!</div>";
        }
        else
        {
            $res = "<div class='alert-danger text-center'>Ваш профиль изменить не удалось!</div>";
        }
        $this->set(['res'=>$res]);
    }
}