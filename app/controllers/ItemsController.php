<?php

namespace app\controllers;
use app\models\Main;
use R;
use vendor\core\App;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use vendor\core\base\View;

class ItemsController extends AppController
{
    public function indexAction()
    {
        $main = new Main();
    }

    public function viewAction()
    {
        $main = new Main();

        if ($_GET['id'] != $_SESSION['countid'])
        {
            $count = R::findOne('tableproducts', "WHERE id=?",[$_GET['id']]);
            $new_count = $count['count'] + 1;
            R::exec( "UPDATE tableproducts SET count='{$new_count}' WHERE id = '{$_GET['id']}'" );
        }
        $_SESSION['countid'] = $_GET['id'];

        if (isset($_GET['id']))
        {
            $item = R::findOne('tableproducts', "WHERE id=?",[$_GET['id']]);
            $image = R::findAll('uploadsimages', "products_id=?",[$_GET['id']]);
            $comments = R::findAll('reviews', "WHERE products_id='{$_GET['id']}' AND moderat='1' ORDER BY id DESC");
            $count_com = R::count('reviews',"WHERE products_id='{$_GET['id']}' AND moderat='1'");
        }

        $random = R::getAll("SELECT DISTINCT * FROM tableproducts WHERE visible='1' ORDER BY RAND() LIMIT 3");

        View::setMeta($item['title'],$item['seo_words'],$item['seo_description']);
        $this->set(['item'=>$item,'image'=>$image, 'comments'=>$comments,'count_com'=>$count_com, 'random'=>$random]);
    }

    public function sendreviewAction()
    {
        $main = new Main();

        $var = R::dispense('reviews');
        $var->products_id = $_POST['id'];
        $var->name = $_POST['name'];
        $var->good_review = $_POST['good'];
        $var->bad_review = $_POST['bad'];
        $var->comment = $_POST['com'];
        $var->date = date('Y-m-d');
        $var->moderat = 0;
        $id = R::store($var);
        die;
    }

    public function likeAction()
    {
        $main = new Main();

        if (isset($_POST['id']))
        {
            if ($_SESSION['like'] != (int)$_POST['id'])
            {
                $like = R::findOne('tableproducts', "WHERE id='{$_POST['id']}'");
                if ($like > 0)
                {
                    $new_count = $like['like_ok'] + 1;

                    $like = R::load('tableproducts', $_POST['id']);
                    $like->like_ok = $new_count;
                    R::store($like);
                    //
                    $_SESSION['like'] = (int)$_POST['id'];
                    echo $new_count;
                    die;
                }
            }
            else
            {
                echo 'no';
                die;
            }
        }
        die;
    }
}