<?php

namespace app\controllers;
use app\models\Auth;
use R;
use vendor\core\App;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use vendor\core\base\View;
use PHPMailer\PHPMailer\PHPMailer;
use vendor\libs\Genpass;

class AuthController extends AppController
{
    public function indexAction()
    {
        $user = new Auth();
    }

    public function registrationAction()
    {
        $user = new Auth();
        if (isset($_POST['reg_btn']))
        {
            $errors = [];
            if (trim($_POST['login']) == '') {$errors[] = 'Введите логин!';}
            if (trim($_POST['email']) == '') {$errors[] = 'Введите Email!';}
            if ($_POST['pass'] == '') {$errors[] = 'Введите пароль!';}
            if ($_POST['pass2'] != $_POST['pass']) {$errors[] = 'Повторный пароль введен не верно!';}
            if (trim($_POST['fam']) == '') {$errors[] = 'Введите свою фамилию!';}
            if (trim($_POST['name']) == '') {$errors[] = 'Введите имя!';}
            if (trim($_POST['tel']) == '') {$errors[] = 'Введите номер телефона!';}
            if (trim($_POST['address']) == '') {$errors[] = 'Введите адрес доставки!';}
            if (R::count('users', "login = ?", [$_POST['login']]) > 0) {$errors[] = 'Пользователь с таким логином уже существует!';}
            if (R::count('users', "email = ?", [$_POST['email']]) > 0) {$errors[] = 'Пользователь с таким Email уже существует!';}
            if (empty($errors)) {
                $user = R::dispense('users');
                $user->name = $_POST['name'];
                $user->fam = $_POST['fam'];
                $user->email = $_POST['email'];
                $user->pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
                $user->login = $_POST['login'];
                $user->address = $_POST['address'];
                $user->tel = $_POST['tel'];
                $user->created_at = date("Y-m-d H:i:s");
                $user->ip = $_SERVER["REMOTE_ADDR"];
                R::store($user);
                $logger = new Logger('REGISTER_USER');
                $logger->pushHandler(new StreamHandler(ROOT.'/logs/register/log', Logger::INFO));
                $logger->info('Register user', ['login'=>$_POST['login']]);
                $res =  '<div class="alert-success text-center">Вы успешно зарегистрировались!</div><hr>';
            }
            else
            {
                $res = '<div class="alert-danger text-center">'.array_shift($errors).'</div><hr>';
            }

        }
        $this->set(['res'=>$res]);
    }

    public function loginAction()
    {
        $user = new Auth();

        if (isset($_POST['auth-user']))
        {
            $errors = [];
            $user = R::findOne('users', 'login = ?', [$_POST['login']]);
            if ($user)
            {
                if(password_verify($_POST['pass'], $user->pass))
                {
                    $_SESSION['login'] = $user->login;
                    $_SESSION['name'] = $user->name;
                    $_SESSION['fam'] = $user->fam;
                    $_SESSION['email'] = $user->email;
                    $_SESSION['address'] = $user->address;
                    $_SESSION['tel'] = $user->tel;
                    $_SESSION['id'] = $user->id;

                    $logger = new Logger('LOGIN_USER');
                    $logger->pushHandler(new StreamHandler(ROOT.'/logs/login/log', Logger::INFO));
                    $logger->info('Login user', ['login'=>$_POST['login']]);
                    header('Location: /');
                }
                else
                {
                    $errors[] = 'Не верно введен пароль!';
                }
            }
            else
            {
                $errors[] = 'Пользователь с таким логином не найден!';
            }
            if (!empty($errors))
            {
                $res = '<div class="col-md-12 text-center alert-danger">'.array_shift($errors).'</div>';
            }
        }
        $this->set(['res'=>$res]);
    }

    public function logoutAction()
    {
        unset($_SESSION['login']);
        unset($_SESSION['name']);
        unset($_SESSION['fam']);
        unset($_SESSION['tel']);
        unset($_SESSION['email']);
        unset($_SESSION['address']);
        unset($_SESSION['id']);
        unset($_SESSION['order_fio']);
        unset($_SESSION['order_email']);
        unset($_SESSION['order_tel']);
        unset($_SESSION['order_address']);
        unset($_SESSION['order_text']);
        unset($_SESSION['order_delivery']);
        header('Location: /');
    }

    public function remindAction()
    {
        $user = new Auth();
        $message = Genpass::gen();
        if(isset($_POST['email']))
        {
            $remind = R::findOne('users', "email='{$_POST['email']}'");
            $email = $remind['email'];

            if ($email == trim($_POST['email']))
            {
                $mail = new PHPMailer;
                $mail->CharSet = 'UTF-8';
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'miusov@gmail.com';
                $mail->Password = '*********';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                $mail->setFrom('from@example.com', 'Shop');
                $mail->addAddress($email, $remind['name']);
                $mail->isHTML(false);

                $mail->Subject = 'Восстановление пароля.';
                $mail->Body    = 'Ваш новый пароль для входа на сайт: '.$message;

                if(!$mail->send()) {
                    echo 'ERROR';
                    die;
                } else {
                    $us = R::load('users', $remind['id']);
                    $us->pass = password_hash($message, PASSWORD_DEFAULT);
                    R::store($us);
                    echo 'OK';
                    die;
                }
            }
            else
            {
                echo 'ERROR';
                die;
            }
        }

    }

}