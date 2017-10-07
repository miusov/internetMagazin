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
        $brand = R::getAll('SELECT * FROM category,brand WHERE brand.cat_id=category.id');

        if (isset($_POST['add-cat-category']))
        {
            if (!$_POST['type']) $mess = "<div class='alert-danger text-center'>Укажите категорию!</div>";

            if (empty($mess))
            {
                $var = R::dispense('category');
                $var->type = $_POST['type'];
                $id = R::store($var);
                header('Location: /admincategory');
            }
        }

	        if (isset($_POST['add-brand']))
	        {
		        if (!$_POST['brand']) $mess = "<div class='alert-danger text-center'>Укажите бренд и категорию бренда!</div>";

		        if (empty($mess))
		        {
			        $var = R::dispense('brand');
			        $var->brand = $_POST['brand'];
			        $var->cat_id = $_POST['brand-cat-type'];
			        $id = R::store($var);
			        header('Location: /admincategory');
		        }
	        }

        $this->set(['category'=>$category,'brand'=>$brand,'mess'=>$mess]);
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
	        R::getAll('DELETE FROM brand WHERE cat_id=?',[$_POST['id']]);

            echo 'del';
            die;
        }
    }

	public function delbrandAction()
	{
		$main = new Main();

		if (isset($_POST['id']))
		{
			$del = R::load('brand', $_POST['id']);
			R::trash($del);

			echo 'del';
			die;
		}
	}

}