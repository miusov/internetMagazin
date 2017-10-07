<?php
namespace app\controllers;
use app\models\Main;
use R;
use vendor\core\base\View;

class AdmincategoryController extends AppController
{
    public function indexAction()
    {
        if ($_SESSION['auth_admin'] == 'ok')
        {
        View::setMeta('КАТЕГОРИИ');
        $main = new Main();
        $this->layout = 'admin';

        $category = R::findAll('category','ORDER BY id DESC');

        if (isset($_POST['add-cat-category']))
        {
            if (!$_POST['type']) $mess = "<div class='alert-danger text-center'>Укажите тип товара!</div>";
            if (!$_POST['brand']) $mess = "<div class='alert-danger text-center'>Укажите бренд!</div>";

            if (empty($mess))
            {
                $var = R::dispense('category');
                $var->type = $_POST['type'];
                $var->brand = $_POST['brand'];
                $id = R::store($var);
                header('Location: /admincategory');
            }
        }

        $this->set(['category'=>$category,'mess'=>$mess]);
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
            $del = R::load('category', $_POST['id']);
            R::trash($del);
            echo 'del';
            die;
        }
    }

}