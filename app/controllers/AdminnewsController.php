<?php
namespace app\controllers;
use app\models\Main;
use Monolog\Handler\IFTTTHandler;
use R;
use vendor\core\base\View;

class AdminnewsController extends AppController
{
    public function indexAction()
    {
        if ($_SESSION['auth_admin'] == 'ok')
        {
        View::setMeta('НОВОСТИ');
        $main = new Main();
        $this->layout = 'admin';

        $count = R::count('news');
        $news = R::findAll('news',"ORDER BY id DESC");


        $this->set(['count'=>$count,'news'=>$news]);
        }
        else
        {
            redirect('/admin/login');
        }
    }

    public function delAction()
    {
        $main = new Main();

        if (isset($_POST['id']))
        {
            $del = R::load('news', $_POST['id']);
            R::trash($del);
	        echo 'del';
            die;
        }
    }

    public function addnewsAction()
    {
        $main = new Main();
        if ($_POST['title'] != '' && $_POST['text'] != '')
        {
            $var = R::dispense('news');
            $var->title = $_POST['title'];
            $var->text = $_POST['text'];
            $var->date = date('Y-m-d');
            $id = R::store($var);
	        $_SESSION['mess'] = "<div class='alert-success text-center message'>Запись добавлена!</div>";
	        echo 'OK';
            die;
        }
        else
        {
            echo "<div class='alert-danger text-center'>Заполните все поля!</div>";
            die;
        }


    }

}