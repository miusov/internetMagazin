<?php

namespace app\controllers;
use app\models\Main;
use R;
use vendor\core\App;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use vendor\core\base\View;
use PHPMailer\PHPMailer\PHPMailer;

class AdminController extends AppController
{
    public function indexAction()
    {
        if ($_SESSION['auth_admin'] == 'ok')
        {
            View::setMeta('Админ панель');
            $main = new Main();
            $this->layout = 'admin';

            $orders = R::count('orders');
            $products = R::count('tableproducts');
            $reviews = R::count('reviews');
            $clients = R::count('reguser');

            $ordprod = R::getAll("SELECT * FROM orders,buyproducts WHERE orders.order_pay='accepted' AND orders.id=buyproducts.buy_id_order");

            $this->set(['orders'=>$orders,'products'=>$products,'reviews'=>$reviews,'clients'=>$clients,'ordprod'=>$ordprod]);
        }
        else
        {
            redirect('/admin/login');
        }
    }

    public function tovariAction()
    {
        if ($_SESSION['auth_admin'] == 'ok')
        {
        View::setMeta('Админ панель - ТОВАРЫ');
        $main = new Main();
        $this->layout = 'admin';

        $count_tovar = R::count('tableproducts');

        $num = 10;
            if (isset($_GET['page'])) $page = (int)$_GET['page'];
            if ($count_tovar > 0)
            {
                $total = ceil($count_tovar / $num);

                if (empty($page) OR $page < 0) $page = 1;
                if ($page > $total) $page = $total;

                $start = $page * $num - $num;

                $paginat = " LIMIT $start, $num";
            }
            $pstr_prev = '';
            $pstr_next = '';
            $get = substr($_SERVER['QUERY_STRING'],strpos($_SERVER['QUERY_STRING'], '&')+1).'&';
            if ($page != 1) $pstr_prev = "<li><a href='/admin/tovari?page=".($page - 1)."' class='pstr-prev'>&lt;</a></li>";
            if ($page != $total) $pstr_next = "<li><a href='/admin/tovari?page=".($page + 1)."' class='pstr-next'>&gt;</a></li>";

            if($page - 5 > 0) $page5left = "<li><a href='/admin/tovari?page=".($page - 5)."'>".($page - 5)."</a></li>";
            if($page - 4 > 0) $page4left = "<li><a href='/admin/tovari?page=".($page - 4)."'>".($page - 4)."</a></li>";
            if($page - 3 > 0) $page3left = "<li><a href='/admin/tovari?page=".($page - 3)."'>".($page - 3)."</a></li>";
            if($page - 2 > 0) $page2left = "<li><a href='/admin/tovari?page=".($page - 2)."'>".($page - 2)."</a></li>";
            if($page - 1 > 0) $page1left = "<li><a href='/admin/tovari?page=".($page - 1)."'>".($page - 1)."</a></li>";

            if($page + 5 <= $total) $page5right = "<li><a href='/admin/tovari?page=".($page + 5)."'>".($page + 5)."</a></li>";
            if($page + 4 <= $total) $page4right = "<li><a href='/admin/tovari?page=".($page + 4)."'>".($page + 4)."</a></li>";
            if($page + 3 <= $total) $page3right = "<li><a href='/admin/tovari?page=".($page + 3)."'>".($page + 3)."</a></li>";
            if($page + 2 <= $total) $page2right = "<li><a href='/admin/tovari?page=".($page + 2)."'>".($page + 2)."</a></li>";
            if($page + 1 <= $total) $page1right = "<li><a href='/admin/tovari?page=".($page + 1)."'>".($page + 1)."</a></li>";

            if ($page + 5 < $total)
            {
                $strtotal = "<li><p class='nav-point'>...</p></li><li><a href='/admin/tovari?page=".($total)."'>".($total)."</a></li>";
            }
            else
            {
                $strtotal = '';
            }
            if ($total > 1)
            {
                $pagin =  @$pstr_prev.@$page5left.@$page4left.@$page3left.@$page2left.@$page1left."<li><a class='pstr-active' href='/admin/tovari?page=".($page)."'>".($page)."</a></li>".@$page1right.@$page2right.@$page3right.@$page4right.@$page5right.$strtotal.$pstr_next;
            }
        if (isset($_GET['search']) || isset($_GET['search_input']))
        {
            $tovari = R::findAll('tableproducts', "WHERE title LIKE '%{$_GET['search_input']}%' ORDER BY id DESC");
        }
        else
        {
            $tovari = R::findAll('tableproducts', "ORDER BY id DESC $paginat");
        }



        $this->set(['count_tovar'=>$count_tovar, 'tovari'=>$tovari, 'pagin'=>$pagin]);

        }
        else
        {
            redirect('/admin/login');
        }
    }


    public function loginAction()
    {
        View::setMeta('Админ панель - ВХОД');
        $main = new Main();
        $this->layout = 'admin-login';

        if (isset($_POST['signin']))
        {
            $login = $this->clr_str($_POST['login']);
            $pass = $this->clr_str($_POST['pass']);

            if($login != '' && $pass != '')
            {
                $user = R::findOne('regadmin',"WHERE login=?",[$login]);

                if($user > 0)
                {
                    if(password_verify($_POST['pass'], $user->pass)) {
                        $_SESSION['auth_admin'] = 'ok';
                        $_SESSION['you'] = $user['role'];

//                        Привелегии
//                      Заказы
                        $_SESSION['rev_zak'] = $user['rev_zak'];
                        $_SESSION['wrk_zak'] = $user['wrk_zak'];
                        $_SESSION['del_zak'] = $user['del_zak'];
//                        Товары
                        $_SESSION['add_tov'] = $user['add_tov'];
                        $_SESSION['edt_tov'] = $user['edt_tov'];
                        $_SESSION['del_tov'] = $user['del_tov'];
//                        Отзывы
                        $_SESSION['mod_otz'] = $user['mod_otz'];
                        $_SESSION['del_otz'] = $user['del_otz'];
//                        Клиенты
                        $_SESSION['rev_cln'] = $user['rev_cln'];
                        $_SESSION['del_cln'] = $user['del_cln'];
//                        Новости
                        $_SESSION['add_nes'] = $user['add_nes'];
                        $_SESSION['del_nes'] = $user['del_nes'];
//                        Категории
                        $_SESSION['add_cat'] = $user['add_cat'];
                        $_SESSION['del_cat'] = $user['del_cat'];
//                        Администраторы
                        $_SESSION['rev_adm'] = $user['rev_adm'];

                        echo "<script>location.href = '/admin/index';</script>";
                    }
                    else
                    {
                        echo "<div class='alert-danger text-center'><h3>Не верный логин и(или) пароль!</h3></div>";
                    }
                }
            }
            else
            {
                echo "<div class='alert-danger text-center'><h3>Нужно заполнить все поля!</h3></div>";
            }
        }
    }

    public function logoutAction()
    {
        unset($_SESSION['auth_admin']);
        unset($_SESSION['you']);
        unset($_SESSION['rev_zak']);
        unset($_SESSION['wrk_zak']);
        unset($_SESSION['del_zak']);
        unset($_SESSION['add_tov']);
        unset($_SESSION['edt_tov']);
        unset($_SESSION['del_tov']);
        unset($_SESSION['mod_otz']);
        unset($_SESSION['del_otz']);
        unset($_SESSION['rev_cln']);
        unset($_SESSION['del_cln']);
        unset($_SESSION['add_nes']);
        unset($_SESSION['del_nes']);
        unset($_SESSION['add_cat']);
        unset($_SESSION['del_cat']);
        unset($_SESSION['rev_adm']);

        redirect('/admin/login');
    }
}