<?php

namespace app\controllers;
use app\models\Main;
use R;
use vendor\core\App;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use vendor\core\base\View;
use PHPMailer\PHPMailer\PHPMailer;

class AdminordersController extends AppController
{
    public function indexAction()
    {
        if ($_SESSION['auth_admin'] == 'ok')
        {
            View::setMeta('ЗАКАЗЫ');
            $main = new Main();
            $this->layout = 'admin';

            $count_orders = R::count('orders');
            $okord = R::count('orders',"WHERE order_confirm='ok'");
            $noord = R::count('orders',"WHERE order_confirm='no'");

            if ($_GET['sort'] == 'all') $count = R::count('orders');
            if ($_GET['sort'] == 'mod') $count = R::count('orders',"WHERE order_confirm='ok'");
            if ($_GET['sort'] == 'nomod') $count = R::count('orders',"WHERE order_confirm='no'");

            $num = 10;
            if (isset($_GET['page'])) $page = (int)$_GET['page'];
            if ($count > 0)
            {
                $total = ceil($count / $num);

                if (empty($page) OR $page < 0) $page = 1;
                if ($page > $total) $page = $total;

                $start = $page * $num - $num;

                $paginat = " LIMIT $start, $num";
            }
            $pstr_prev = '';
            $pstr_next = '';
            $get = substr($_SERVER['QUERY_STRING'],strpos($_SERVER['QUERY_STRING'], '&')+1).'&';
            if ($page != 1) $pstr_prev = "<li><a href='/adminorders?".$get."page=".($page - 1)."' class='pstr-prev'>&lt;</a></li>";
            if ($page != $total) $pstr_next = "<li><a href='/adminorders?".$get."page=".($page + 1)."' class='pstr-next'>&gt;</a></li>";

            if($page - 5 > 0) $page5left = "<li><a href='/adminorders?".$get."page=".($page - 5)."'>".($page - 5)."</a></li>";
            if($page - 4 > 0) $page4left = "<li><a href='/adminorders?".$get."page=".($page - 4)."'>".($page - 4)."</a></li>";
            if($page - 3 > 0) $page3left = "<li><a href='/adminorders?".$get."page=".($page - 3)."'>".($page - 3)."</a></li>";
            if($page - 2 > 0) $page2left = "<li><a href='/adminorders?".$get."page=".($page - 2)."'>".($page - 2)."</a></li>";
            if($page - 1 > 0) $page1left = "<li><a href='/adminorders?".$get."page=".($page - 1)."'>".($page - 1)."</a></li>";

            if($page + 5 <= $total) $page5right = "<li><a href='/adminorders?".$get."page=".($page + 5)."'>".($page + 5)."</a></li>";
            if($page + 4 <= $total) $page4right = "<li><a href='/adminorders?".$get."page=".($page + 4)."'>".($page + 4)."</a></li>";
            if($page + 3 <= $total) $page3right = "<li><a href='/adminorders?".$get."page=".($page + 3)."'>".($page + 3)."</a></li>";
            if($page + 2 <= $total) $page2right = "<li><a href='/adminorders?".$get."page=".($page + 2)."'>".($page + 2)."</a></li>";
            if($page + 1 <= $total) $page1right = "<li><a href='/adminorders?".$get."page=".($page + 1)."'>".($page + 1)."</a></li>";

            if ($page + 5 < $total)
            {
                $strtotal = "<li><p class='nav-point'>...</p></li><li><a href='/adminorders?".$get."page=".($total)."'>".($total)."</a></li>";
            }
            else
            {
                $strtotal = '';
            }
            if ($total > 1)
            {
                $pagin =  @$pstr_prev.@$page5left.@$page4left.@$page3left.@$page2left.@$page1left."<li><a class='pstr-active' href='/adminorders?".$get."page=".($page)."'>".($page)."</a></li>".@$page1right.@$page2right.@$page3right.@$page4right.@$page5right.$strtotal.$pstr_next;
            }

            $orders = R::findAll('orders',"WHERE order_confirm='no' ORDER BY id DESC");
            if (isset($_GET['sort']))
            {
                if ($_GET['sort'] == 'all') $orders = R::findAll('orders',"ORDER BY id DESC {$paginat}");
                if ($_GET['sort'] == 'ok') $orders = R::findAll('orders',"WHERE order_confirm='ok' ORDER BY id DESC {$paginat}");
                if ($_GET['sort'] == 'no') $orders = R::findAll('orders',"WHERE order_confirm='no' ORDER BY id DESC {$paginat}");
            }
            else
            {
                $_GET['sort'] = 'no';
            }


            $this->set(['count_orders'=>$count_orders,'okord'=>$okord,'noord'=>$noord,'pagin'=>$pagin,'orders'=>$orders]);
        }
        else
        {
            header('Location: /admin/login');
        }
    }

    public function viewAction()
    {
        if ($_SESSION['auth_admin'] == 'ok') {
            View::setMeta('Просмотр заказа');
            $main = new Main();
            $this->layout = 'admin';

            if (isset($_GET['id']))
            {
                $order = R::findOne('orders',"WHERE id=?",[$_GET['id']]);
                $buy = R::getAll("SELECT * FROM buyproducts,tableproducts WHERE buyproducts.buy_id_order={$_GET['id']} AND tableproducts.id=buyproducts.buy_id_product");

                if ($order['order_confirm'] == 'ok')
                {
                    $status = "<span class='green'>Обработан</span>";
                }
                else
                {
                    $status = "<span class='red'>Не обработан</span>";
                }

                if ($order['order_pay'] == 'accepted')
                {
                    $statpay = "<span class='green'>Оплачено</span>";
                }
                else
                {
                    $statpay = "<span class='red'>Не оплачено</span>";
                }

                if (isset($_GET['action']))
                {
                    switch ($_GET['action'])
                    {
                        case 'accept':
                            if ($_SESSION['wrk_zak'] == '1')
                            {
                                $upd = R::load('orders', $_GET['id']);
                                $upd->order_confirm = 'ok';
                                R::store($upd);
                                header("Location: /adminorders/view?id={$_GET['id']}");
                            }
                            else
                            {
                                $mess = "<div class='alert-danger text-center'>У вас нет прав на подтверждение заказов!</div>";
                            }
                            break;

                        case 'delete':
                            if ($_SESSION['del_zak'] == '1')
                            {
                            $del = R::load('orders', $_GET['id']);
                            R::trash($del);
                            R::getAll("DELETE FROM buyproducts WHERE buy_id_order=?",[$_GET['id']]);
                            header("Location: /adminorders?sort=no");
                            }
                            else
                            {
                                $mess = "<div class='alert-danger text-center'>У вас нет прав на удаление заказов!</div>";
                            }
                            break;
                    }
                }




                $this->set(['order'=>$order,'status'=>$status,'statpay'=>$statpay,'buy'=>$buy,'mess'=>$mess]);
            }

        }
        else
        {
            header('Location: /admin/login');
        }
    }

}