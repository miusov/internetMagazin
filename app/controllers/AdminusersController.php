<?php

namespace app\controllers;
use app\models\Main;
use R;
use vendor\core\App;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use vendor\core\base\View;
use PHPMailer\PHPMailer\PHPMailer;

class AdminusersController extends AppController
{
    public function indexAction()
    {
        if ($_SESSION['auth_admin'] == 'ok')
        {
            View::setMeta('КЛИЕНТЫ');
        $main = new Main();
        $this->layout = 'admin';

        $count_clients = R::count('users');

        $num = 10;
        if (isset($_GET['page'])) $page = (int)$_GET['page'];
        if ($count_clients > 0)
        {
            $total = ceil($count_clients / $num);

            if (empty($page) OR $page < 0) $page = 1;
            if ($page > $total) $page = $total;

            $start = $page * $num - $num;

            $paginat = " LIMIT $start, $num";
        }
        $pstr_prev = '';
        $pstr_next = '';
        if ($page != 1) $pstr_prev = "<li><a href='/adminusers?page=".($page - 1)."' class='pstr-prev'>&lt;</a></li>";
        if ($page != $total) $pstr_next = "<li><a href='/adminusers?page=".($page + 1)."' class='pstr-next'>&gt;</a></li>";

        if($page - 5 > 0) $page5left = "<li><a href='/adminusers?page=".($page - 5)."'>".($page - 5)."</a></li>";
        if($page - 4 > 0) $page4left = "<li><a href='/adminusers?page=".($page - 4)."'>".($page - 4)."</a></li>";
        if($page - 3 > 0) $page3left = "<li><a href='/adminusers?page=".($page - 3)."'>".($page - 3)."</a></li>";
        if($page - 2 > 0) $page2left = "<li><a href='/adminusers?page=".($page - 2)."'>".($page - 2)."</a></li>";
        if($page - 1 > 0) $page1left = "<li><a href='/adminusers?page=".($page - 1)."'>".($page - 1)."</a></li>";

        if($page + 5 <= $total) $page5right = "<li><a href='/adminusers?page=".($page + 5)."'>".($page + 5)."</a></li>";
        if($page + 4 <= $total) $page4right = "<li><a href='/adminusers?page=".($page + 4)."'>".($page + 4)."</a></li>";
        if($page + 3 <= $total) $page3right = "<li><a href='/adminusers?page=".($page + 3)."'>".($page + 3)."</a></li>";
        if($page + 2 <= $total) $page2right = "<li><a href='/adminusers?page=".($page + 2)."'>".($page + 2)."</a></li>";
        if($page + 1 <= $total) $page1right = "<li><a href='/adminusers?page=".($page + 1)."'>".($page + 1)."</a></li>";

        if ($page + 5 < $total)
        {
            $strtotal = "<li><p class='nav-point'>...</p></li><li><a href='/adminusers?page=".($total)."'>".($total)."</a></li>";
        }
        else
        {
            $strtotal = '';
        }
        if ($total > 1)
        {
            $pagin =  @$pstr_prev.@$page5left.@$page4left.@$page3left.@$page2left.@$page1left."<li><a class='pstr-active' href='/adminusers?page=".($page)."'>".($page)."</a></li>".@$page1right.@$page2right.@$page3right.@$page4right.@$page5right.$strtotal.$pstr_next;
        }

        $clients = R::findAll('users',"ORDER BY id DESC $paginat");

        $this->set(['count_clients'=>$count_clients,'clients'=>$clients,'pagin'=>$pagin]);
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
            $del = R::load('users', $_POST['id']);
            R::trash($del);
            echo 'del';
            die;
        }
    }

}