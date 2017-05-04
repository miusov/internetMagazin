<?php

namespace app\controllers;
use app\models\Main;
use R;
use vendor\core\App;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use vendor\core\base\View;

class CartController extends AppController
{
    public function indexAction()
    {
        $main = new Main();

        $action = $this->clr_str($_GET['action']);

        switch ($action)
        {
            case 'onclick':
                $cart_res = R::count('cart', "WHERE cart_sid=?",[session_id()]);
                if ($cart_res > 0)
                {
                    $breadcrumbs = "
                    <div id='block-step'>
                        <div id='name-step'>
                            <ul>
                                <li><a href='/cart?action=onclick' class='action-link'>1. Корзина товаров</a></li>
                                <li><span>&rarr;</span></li>
                                <li><a href='/cart?action=confirm'>2. Контактная информация</a></li>
                                <li><span>&rarr;</span></li>
                                <li><a href='/cart?action=completion'>3. Завершение</a></li>
                            </ul>
                        </div>
                        <div class='col-md-6 step'>Шаг 1 из 3 </div>
                        <div class='col-md-6 text-right'><a href='/cart/del?action=clear' class='btn btn-danger'>Очистить корзину</a></div>
                    </div>
                ";
                    $res = R::getAll("SELECT * FROM cart,tableproducts WHERE cart.cart_sid = '".session_id()."' AND tableproducts.id = cart.cart_id_product");


                }
                else
                {
                    $clear = "<br><h2 class='text-center'>Корзина пуста!</h2>";
                }
                break;

            case 'confirm':
                $breadcrumbs = "
                    <div id='block-step'>
                        <div id='name-step'>
                            <ul>
                                <li><a href='/cart?action=onclick'>1. Корзина товаров</a></li>
                                <li><span>&rarr;</span></li>
                                <li><a href='/cart?action=confirm' class='action-link'>2. Контактная информация</a></li>
                                <li><span>&rarr;</span></li>
                                <li><a href='/cart?action=completion'>3. Завершение</a></li>
                            </ul>
                        </div>
                        <div class='col-md-6 step'>Шаг 2 из 3 </div>
                    </div>
                ";
            break;

            case 'completion':
                $breadcrumbs = "
                    <div id='block-step'>
                        <div id='name-step'>
                            <ul>
                                <li><a href='/cart?action=onclick'>1. Корзина товаров</a></li>
                                <li><span>&rarr;</span></li>
                                <li><a href='/cart?action=confirm'>2. Контактная информация</a></li>
                                <li><span>&rarr;</span></li>
                                <li><a href='/cart?action=completion' class='action-link'>3. Завершение</a></li>
                            </ul>
                        </div>
                        <div class='col-md-6 step'>Шаг 3 из 3 </div>
                    </div>
                ";
                $res2 = R::getAll("SELECT * FROM cart,tableproducts WHERE cart.cart_sid = '".session_id()."' AND tableproducts.id = cart.cart_id_product");
                break;

            default:

            break;
        }

        $this->set(['breadcrumbs'=>$breadcrumbs, 'res'=>@$res, 'res2'=>@$res2, 'clear'=>$clear]);
    }

    public function delAction()
    {
        $main = new Main();

        switch ($_GET['action'])
        {
            case 'clear':
                $clear = R::exec("DELETE FROM cart WHERE cart_sid = '".session_id()."'");
                header('Location: /cart?action=onclick');
            break;
            case 'del':
                $del = R::exec("DELETE FROM cart WHERE cart_sid = '".session_id()."' AND cart_id = '{$_GET['task']}'");
                header('Location: /cart?action=onclick');
                break;
        }
    }

    public function confirmAction()
    {
        $main = new Main();
        if (isset($_POST['confirm_btn'])){
            $_SESSION['order_delivery'] = $_POST['radio'];
            $_SESSION['order_fio'] = $_POST['fio'];
            $_SESSION['order_email'] = $_POST['email'];
            $_SESSION['order_tel'] = $_POST['tel'];
            $_SESSION['order_address'] = $_POST['address'];
            $_SESSION['order_text'] = $_POST['text'];

            $order = R::dispense('orders');
            $order->order_date = date('Y-m-d H:i:s');
            $order->order_delivery = $_POST['radio'];
            $order->order_fio = $_POST['fio'];
            $order->order_address = $_POST['address'];
            $order->order_tel = $_POST['tel'];
            $order->order_note = $_POST['text'];
            $order->order_email = $_POST['email'];
            $id = R::store($order);

            $lastorder = R::findLast('orders');
            $_SESSION['order_id'] = $lastorder['id'];

            $cart = R::getAll("SELECT * FROM cart WHERE cart_sid=?",[session_id()]);
            if ($cart > 0)
            {
                foreach ($cart as $k=>$v)
                {
                    $order = R::dispense('buyproducts');
                    $order->buy_id_order = $_SESSION['order_id'];
                    $order->buy_id_product = $v['cart_id_product'];
                    $order->buy_count_product = $v['cart_count'];
                    $id = R::store($order);
                }
            }

        }
        header('Location: /cart?action=completion');
    }

    public function addcartAction()
    {
        $main = new Main();
        if (isset($_POST['id']))
        {
            $cart_add = R::findOne('cart', "WHERE cart_sid='".session_id()."' AND cart_id_product='{$_POST['id']}'");
            if ($cart_add > 0)
            {
                $new_count = $cart_add['cart_count'] + 1;

                R::exec( "UPDATE cart SET cart_count='{$new_count}' WHERE cart_sid = '".session_id()."' AND cart_id_product='{$cart_add['cart_id_product']}'" );

                echo 1;
                die;
            }
            else
            {
                $item = R::findOne('tableproducts', "WHERE id='{$_POST['id']}'");

                R::exec("INSERT INTO cart(cart_id_product,cart_price,cart_count,cart_created_at,cart_sid) VALUES('{$item['id']}','{$item['price']}','1',date('Y-m-d H:i:s'),'".session_id()."')");

                die;
            }
        }

    }

    public function loadcartAction()
    {
        $main = new Main();
        $cart = R::getAll("SELECT * FROM `cart` WHERE cart_sid='".session_id()."'");

        if (count($cart) > 0){
            $count = 0;
            foreach ($cart as $k => $v)
            {
                $count = $count + $v['cart_count'];
                $int = $int + ($v['cart_price'] * $v['cart_count']);
            }
            echo "В корзине <strong>{$count} тов.</strong> на сумму <strong>{$int} грн.</strong>";
            die;
        }
        else
        {
            echo 0;
            die;
        }

    }

    public function minusAction()
    {
        $main = new Main();
        if (isset($_POST['id']))
        {
            $m = R::findOne('cart',"WHERE cart_id=? AND cart_sid = '".session_id()."'",[$_POST['id']]);
            $minus = $m['cart_count'] - 1;
            if ($minus > 0){
                R::exec( "UPDATE cart SET cart_count='{$minus}' WHERE cart_sid = '".session_id()."' AND cart_id='{$_POST['id']}'" );
                echo $minus;
            }
            else
            {
                echo $m['cart_count'];
            }
        }
        die;
    }

    public function plusAction()
    {
        $main = new Main();
        if (isset($_POST['id']))
        {
            $m = R::findOne('cart',"WHERE cart_id=? AND cart_sid = '".session_id()."'",[$_POST['id']]);
            $plus = $m['cart_count'] + 1;
            if ($plus > 0){
                R::exec( "UPDATE cart SET cart_count='{$plus}' WHERE cart_sid = '".session_id()."' AND cart_id='{$_POST['id']}'" );
                echo $plus;
            }
            else
            {
                echo $m['cart_count'];
            }
        }
        die;
    }

    public function itogAction()
    {
        $main = new Main();

        $itog = R::getAll("SELECT * FROM cart WHERE cart_sid=?",[session_id()]);
        if ($itog > 0)
        {
            foreach ($itog as $k => $v)
            {
               $int = $int + ($v['cart_price'] * $v['cart_count']);
            }
            echo $int;
            die;
        }
    }
}