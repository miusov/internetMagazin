<?php

namespace app\controllers;
use app\models\Main;
use R;
use vendor\core\App;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use vendor\core\base\View;
use PHPMailer\PHPMailer\PHPMailer;

class AdminsController extends AppController
{
    public function indexAction()
    {
        $main = new Main;
        if ($_SESSION['auth_admin'] == 'ok')
        {
            View::setMeta('Администраторы');
            $this->layout = 'admin';

            $admins = R::findAll('regadmin',"ORDER BY id DESC");

            $this->set(['admins'=>$admins]);
        }
        else
        {
            header('Location: /admin/login');
        }
    }

    public function addadminAction()
    {
        $main = new Main;
        if ($_SESSION['auth_admin'] == 'ok')
        {
            View::setMeta('Добавление администратора');
            $this->layout = 'admin';

            $mess = [];
            if (isset($_POST['add-admin']))
            {
                $login = $this->clr_str($_POST['login']);
                if ($login != '')
                {
                    $query = R::findOne('regadmin',"WHERE login=?",[$login]);
                    if ($query > 0)
                    {
                        $mess[] = "<div class='alert-danger text-center'>Логин занят!</div><br>";
                    }
                }
                else
                {
                    $mess[] = "<div class='alert-danger text-center'>Укажите логин!</div><br>";
                }

                if (!$_POST['login']) $mess[] = "<div class='alert-danger text-center'>Укажите логин!</div><br>";
                if (!$_POST['pass']) $mess[] = "<div class='alert-danger text-center'>Укажите пароль!</div><br>";
                if (!$_POST['fio']) $mess[] = "<div class='alert-danger text-center'>Укажите Имя!</div><br>";
                if (!$_POST['role']) $mess[] = "<div class='alert-danger text-center'>Укажите должность!</div><br>";
                if (!$_POST['email']) $mess[] = "<div class='alert-danger text-center'>Укажите Email!</div><br>";

                if($_POST['rev_zak'] == '') $_POST['rev_zak'] = 0;
                if($_POST['wrk_zak'] == '') $_POST['wrk_zak'] = 0;
                if($_POST['del_zak'] == '') $_POST['del_zak'] = 0;
                if($_POST['add_tov'] == '') $_POST['add_tov'] = 0;
                if($_POST['edt_tov'] == '') $_POST['edt_tov'] = 0;
                if($_POST['del_tov'] == '') $_POST['del_tov'] = 0;
                if($_POST['mod_otz'] == '') $_POST['mod_otz'] = 0;
                if($_POST['del_otz'] == '') $_POST['del_otz'] = 0;
                if($_POST['rev_cln'] == '') $_POST['rev_cln'] = 0;
                if($_POST['del_cln'] == '') $_POST['del_cln'] = 0;
                if($_POST['add_nes'] == '') $_POST['add_nes'] = 0;
                if($_POST['del_nes'] == '') $_POST['del_nes'] = 0;
                if($_POST['add_cat'] == '') $_POST['add_cat'] = 0;
                if($_POST['del_cat'] == '') $_POST['del_cat'] = 0;
                if($_POST['rev_adm'] == '') $_POST['rev_adm'] = 0;

                if (empty($mess))
                {
                    $user = R::dispense('regadmin');
                    $user->login = $this->clr_str($_POST['login']);
                    $user->pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
                    $user->fio = $this->clr_str($_POST['fio']);
                    $user->role = $this->clr_str($_POST['role']);
                    $user->email = $this->clr_str($_POST['email']);
                    $user->tel = $this->clr_str($_POST['tel']);
                    $user->rev_zak = $_POST['rev_zak'];
                    $user->wrk_zak = $_POST['wrk_zak'];
                    $user->del_zak = $_POST['del_zak'];
                    $user->add_tov = $_POST['add_tov'];
                    $user->edt_tov = $_POST['edt_tov'];
                    $user->del_tov = $_POST['del_tov'];
                    $user->mod_otz = $_POST['mod_otz'];
                    $user->del_otz = $_POST['del_otz'];
                    $user->rev_cln = $_POST['rev_cln'];
                    $user->del_cln = $_POST['del_cln'];
                    $user->add_nes = $_POST['add_nes'];
                    $user->del_nes = $_POST['del_nes'];
                    $user->add_cat = $_POST['add_cat'];
                    $user->del_cat = $_POST['del_cat'];
                    $user->rev_adm = $_POST['rev_adm'];
                    R::store($user);
                    $mess[] = "<div class='alert-success text-center'>Пользователь успешно добавлен!</div><br>";
                }
            }
            $this->set(['mess'=>$mess]);
        }
        else
        {
            header('Location: /admin/login');
        }
    }

    public function delAction()
    {
        $main = new Main();

        if (isset($_POST['id']))
        {
            $admin = R::findOne('regadmin',"WHERE id=?",[$_POST['id']]);
            if ($admin['login'] != 'admin')
            {
                $del = R::load('regadmin', $_POST['id']);
                R::trash($del);
                echo 'del';
                die;
            }
            else
            {
                echo "Не возможно удалить администратора!";
                die;
            }
        }
    }

    public function editadminAction()
    {
        $main = new Main;
        if ($_SESSION['auth_admin'] == 'ok')
        {
            View::setMeta('Редактирование профиля администратора');
            $this->layout = 'admin';

            $mess = [];
            if (isset($_GET['adminid']))
            {
                $admin = R::findOne('regadmin',"WHERE id=?",[$_GET['adminid']]);

                if($admin['rev_zak'] == '1') $rev_zak = 'checked';
                if($admin['wrk_zak'] == '1') $wrk_zak = 'checked';
                if($admin['del_zak'] == '1') $del_zak = 'checked';
                if($admin['add_tov'] == '1') $add_tov = 'checked';
                if($admin['edt_tov'] == '1') $edt_tov = 'checked';
                if($admin['del_tov'] == '1') $del_tov = 'checked';
                if($admin['mod_otz'] == '1') $mod_otz = 'checked';
                if($admin['del_otz'] == '1') $del_otz = 'checked';
                if($admin['rev_cln'] == '1') $rev_cln = 'checked';
                if($admin['del_cln'] == '1') $del_cln = 'checked';
                if($admin['add_nes'] == '1') $add_nes = 'checked';
                if($admin['del_nes'] == '1') $del_nes = 'checked';
                if($admin['add_cat'] == '1') $add_cat = 'checked';
                if($admin['del_cat'] == '1') $del_cat = 'checked';
                if($admin['rev_adm'] == '1') $rev_adm = 'checked';
            }
            if (isset($_POST['edit-admin']))
            {
                if (!$_POST['login']) $mess[] = "<div class='alert-danger text-center'>Укажите логин!</div><br>";
                if (!$_POST['fio']) $mess[] = "<div class='alert-danger text-center'>Укажите Имя!</div><br>";
                if (!$_POST['role']) $mess[] = "<div class='alert-danger text-center'>Укажите должность!</div><br>";
                if (!$_POST['email']) $mess[] = "<div class='alert-danger text-center'>Укажите Email!</div><br>";

                if($_POST['rev_zak'] == '') $_POST['rev_zak'] = 0;
                if($_POST['wrk_zak'] == '') $_POST['wrk_zak'] = 0;
                if($_POST['del_zak'] == '') $_POST['del_zak'] = 0;
                if($_POST['add_tov'] == '') $_POST['add_tov'] = 0;
                if($_POST['edt_tov'] == '') $_POST['edt_tov'] = 0;
                if($_POST['del_tov'] == '') $_POST['del_tov'] = 0;
                if($_POST['mod_otz'] == '') $_POST['mod_otz'] = 0;
                if($_POST['del_otz'] == '') $_POST['del_otz'] = 0;
                if($_POST['rev_cln'] == '') $_POST['rev_cln'] = 0;
                if($_POST['del_cln'] == '') $_POST['del_cln'] = 0;
                if($_POST['add_nes'] == '') $_POST['add_nes'] = 0;
                if($_POST['del_nes'] == '') $_POST['del_nes'] = 0;
                if($_POST['add_cat'] == '') $_POST['add_cat'] = 0;
                if($_POST['del_cat'] == '') $_POST['del_cat'] = 0;
                if($_POST['rev_adm'] == '') $_POST['rev_adm'] = 0;

                if (empty($mess))
                {
                    $user = R::load('regadmin', $_POST['admin-id']);
                    $user->login = $this->clr_str($_POST['login']);
                    if ($_POST['pass'] != '') $user->pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
                    $user->fio = $this->clr_str($_POST['fio']);
                    $user->role = $this->clr_str($_POST['role']);
                    $user->email = $this->clr_str($_POST['email']);
                    $user->tel = $this->clr_str($_POST['tel']);
                    $user->rev_zak = $_POST['rev_zak'];
                    $user->wrk_zak = $_POST['wrk_zak'];
                    $user->del_zak = $_POST['del_zak'];
                    $user->add_tov = $_POST['add_tov'];
                    $user->edt_tov = $_POST['edt_tov'];
                    $user->del_tov = $_POST['del_tov'];
                    $user->mod_otz = $_POST['mod_otz'];
                    $user->del_otz = $_POST['del_otz'];
                    $user->rev_cln = $_POST['rev_cln'];
                    $user->del_cln = $_POST['del_cln'];
                    $user->add_nes = $_POST['add_nes'];
                    $user->del_nes = $_POST['del_nes'];
                    $user->add_cat = $_POST['add_cat'];
                    $user->del_cat = $_POST['del_cat'];
                    $user->rev_adm = $_POST['rev_adm'];
                    R::store($user);

                    $mess[] = "<div class='alert-success text-center'>Пользователь успешно изменен!</div><br>";
                }
            }

            $this->set(['admin'=>$admin,
                        'rev_zak'=>$rev_zak,
                        'wrk_zak'=>$wrk_zak,
                        'del_zak'=>$del_zak,
                        'add_tov'=>$add_tov,
                        'edt_tov'=>$edt_tov,
                        'del_tov'=>$del_tov,
                        'mod_otz'=>$mod_otz,
                        'del_otz'=>$del_otz,
                        'rev_cln'=>$rev_cln,
                        'del_cln'=>$del_cln,
                        'add_nes'=>$add_nes,
                        'del_nes'=>$del_nes,
                        'add_cat'=>$add_cat,
                        'del_cat'=>$del_cat,
                        'rev_adm'=>$rev_adm,
                        'mess'=>$mess]);
        }
        else
        {
            header('Location: /admin/login');
        }
    }
}