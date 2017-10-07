<?php

namespace app\controllers;
use app\models\Main;
use R;
use vendor\core\App;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use vendor\core\base\View;
use PHPMailer\PHPMailer\PHPMailer;

class MainController extends AppController
{
    public function indexAction()
    {
        $main = new Main();

        // сортировка товаров ------------------------------
        $sorting = '';
        if (isset($_GET['sort'])) $sorting = $this->clr_str($_GET['sort']);

        switch ($sorting)
        {
            case 'price-asc';
                $sorting = "price ASC";
                $sort_name = 'От дешевых к дорогим';
                break;
            case 'price-desc';
                $sorting = "price DESC";
                $sort_name = 'От дорогих к дешевым';
                break;
            case 'popular';
                $sorting = "count DESC";
                $sort_name = 'Популярные';
                break;
            case 'new';
                $sorting = "created_at DESC";
                $sort_name = 'Новинки';
                break;
            case 'brand';
                $sorting = "brand";
                $sort_name = 'от А до Я';
                break;
            default:
                $sorting = "id DESC";
                $sort_name = 'Нет сортировки';
                break;
        }

        //групировка товаров по котегории ------------------------------

        if (isset($_GET['brand'])) $brand = $this->clr_str($_GET['brand']);
        if (isset($_GET['type'])) $type = $this->clr_str($_GET['type']);

        if (isset($brand) && isset($type))
        {
            $querycat = "AND brand='$brand' AND type_tovara='$type'";
        }
        else
        {
            if (isset($type))
            {
                $querycat = "AND type_tovara='$type'";
            }
            else
            {
                $querycat = '';
            }
        }

        //фильтр по цене и бренду ------------------------------

        $start_price = 0;
        $end_price = 999999;

        if (isset($_GET['submit']))
        {
            if (isset($_GET['brands'])) $check_brands = implode(',', $_GET['brands']);
            $start_price = (int)$_GET['start_price'];
            setcookie('start', $start_price, time()+300);
            if ($start_price > 49800) $start_price = 0;
            $end_price = (int)$_GET['end_price'];
            setcookie('end', $end_price, time()+300);
            if ($end_price > 50000) $start_price = 50000;
        }

        if (isset($check_brands) OR isset($end_price))
        {
            if (isset($check_brands)) $query_brand = " AND brand_id IN($check_brands)";
            if (isset($end_price)) $query_brand = " AND price BETWEEN $start_price AND $end_price";
            if (isset($check_brands) AND isset($end_price)) $query_brand = " AND brand_id IN($check_brands) AND price BETWEEN $start_price AND $end_price";
        }

        //PAGINATION ------------------------------

        $num = COUNT_ITEM;
        if (isset($_GET['page'])) $page = (int)$_GET['page'];

        if (isset($brand) && isset($type)) {$count = R::count('tableproducts', "WHERE visible=1 AND brand='$brand' AND type_tovara='$type'");}
        elseif (isset($type)) {$count = R::count('tableproducts', "WHERE visible=1 AND type_tovara='$type'");}
        elseif (isset($check_brands)) {$count = R::count('tableproducts', "WHERE visible=1 AND brand_id IN($check_brands)");}
        elseif (isset($_GET['end_price'])) {$count = R::count('tableproducts', "WHERE visible=1 AND price BETWEEN $start_price AND {$_GET['end_price']}");}
        elseif (isset($check_brands) && isset($_GET['end_price'])) {$count = R::count('tableproducts', "WHERE visible=1 AND brand_id IN($check_brands) AND price BETWEEN $start_price AND {$_GET['end_price']}");}
        elseif (isset($_GET['search'])) {$count = R::count('tableproducts', "WHERE title LIKE '%{$_GET['search_input']}%' AND visible=1");}
        elseif (isset($_GET['go']) && $_GET['go'] == 'new') {$count = R::count('tableproducts', "WHERE new='1' AND visible=1");}
        elseif (isset($_GET['go']) && $_GET['go'] == 'leader') {$count = R::count('tableproducts', "WHERE leader='1' AND visible=1");}
        elseif (isset($_GET['go']) && $_GET['go'] == 'sale') {$count = R::count('tableproducts', "WHERE sale='1' AND visible=1");}
        else {$count = R::count('tableproducts', 'WHERE visible=1');}

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
            if ($page != 1) $pstr_prev = "<li><a href='/main?".$get."page=".($page - 1)."' class='pstr-prev'>&lt;</a></li>";
            if ($page != $total) $pstr_next = "<li><a href='/main?".$get."page=".($page + 1)."' class='pstr-next'>&gt;</a></li>";

            if($page - 5 > 0) $page5left = "<li><a href='/main?".$get."page=".($page - 5)."'>".($page - 5)."</a></li>";
            if($page - 4 > 0) $page4left = "<li><a href='/main?".$get."page=".($page - 4)."'>".($page - 4)."</a></li>";
            if($page - 3 > 0) $page3left = "<li><a href='/main?".$get."page=".($page - 3)."'>".($page - 3)."</a></li>";
            if($page - 2 > 0) $page2left = "<li><a href='/main?".$get."page=".($page - 2)."'>".($page - 2)."</a></li>";
            if($page - 1 > 0) $page1left = "<li><a href='/main?".$get."page=".($page - 1)."'>".($page - 1)."</a></li>";

            if($page + 5 <= $total) $page5right = "<li><a href='/main?".$get."page=".($page + 5)."'>".($page + 5)."</a></li>";
            if($page + 4 <= $total) $page4right = "<li><a href='/main?".$get."page=".($page + 4)."'>".($page + 4)."</a></li>";
            if($page + 3 <= $total) $page3right = "<li><a href='/main?".$get."page=".($page + 3)."'>".($page + 3)."</a></li>";
            if($page + 2 <= $total) $page2right = "<li><a href='/main?".$get."page=".($page + 2)."'>".($page + 2)."</a></li>";
            if($page + 1 <= $total) $page1right = "<li><a href='/main?".$get."page=".($page + 1)."'>".($page + 1)."</a></li>";

            if ($page + 5 < $total)
            {
                $strtotal = "<li><p class='nav-point'>...</p></li><li><a href='/main?".$get."page=".($total)."'>".($total)."</a></li>";
            }
            else
            {
                $strtotal = '';
            }
            if ($total > 1)
            {
                $pagin =  @$pstr_prev.@$page5left.@$page4left.@$page3left.@$page2left.@$page1left."<li><a class='pstr-active' href='/main?".$get."page=".($page)."'>".($page)."</a></li>".@$page1right.@$page2right.@$page3right.@$page4right.@$page5right.$strtotal.$pstr_next;
            }

            // в $prod попадает массив для вывода товаров------------------------------
	    $empty = '';
        if ((isset($brand) && isset($type)) || isset($type) || (isset($brand) && isset($type) && isset($sorting)) || isset($type) && isset($sorting))
        {
            $prod = R::findAll("tableproducts", "WHERE visible=1 $querycat ORDER BY $sorting $paginat");
        }
        elseif (isset($check_brands) || isset($_GET['end_price']) || (isset($check_brands) && isset($_GET['end_price'])) || isset($check_brands) && isset($sorting) || isset($_GET['end_price']) && isset($sorting) || (isset($check_brands) && isset($_GET['end_price']) && isset($sorting)))
        {
            $prod = R::findAll("tableproducts", "WHERE visible=1 $query_brand ORDER BY $sorting $paginat");
        }
        elseif (isset($_GET['go']) && $_GET['go'] == 'new')
        {
            $prod = R::findAll("tableproducts", "WHERE visible=1 $query_brand AND new='1' ORDER BY $sorting $paginat");
        }
        elseif (isset($_GET['go']) && $_GET['go'] == 'leader')
        {
            $prod = R::findAll("tableproducts", "WHERE visible=1 $query_brand AND leader='1' ORDER BY $sorting $paginat");
        }
        elseif (isset($_GET['go']) && $_GET['go'] == 'sale')
        {
            $prod = R::findAll("tableproducts", "WHERE visible=1 $query_brand AND sale='1' ORDER BY $sorting $paginat");
        }
        elseif (isset($_GET['search']))
        {
            $prod = R::findAll("tableproducts", "WHERE title LIKE '%{$_GET['search_input']}%' AND visible=1 ORDER BY $sorting $paginat");
            if (empty($prod)) $empty = "По данному запросу ничего не найдено.";
        }
        else
        {
            $prod = R::findAll("tableproducts", "WHERE visible=1 ORDER BY $sorting $paginat");
        }


//        AUTH--------------------------------

        $this->set([
        'prod'=>$prod,
        'empty'=>$empty,
        'sort_name'=>$sort_name,
        'start_price'=>$start_price,
        'end_price'=>$end_price,
        'pagin'=>$pagin
        ]);


    }

    public function searchAction()
    {
        $main = new Main();

        if (isset($_POST['text']))
        {
            $text = strtolower(trim($_POST['text']));
            $search = R::findAll('tableproducts', "WHERE title LIKE '%{$text}%' AND visible='1' LIMIT 7");

            foreach ($search as $k => $v)
            {
                echo "<li><a href='/main?search_input={$v['title']}&search=search'>{$v['title']}</a></li>";
            }
        }
        die;
    }

    public function contactsAction()
    {
        $main = new Main();

        if (isset($_POST['cont_form']))
        {
            $mail2 = new PHPMailer;
            $mail2->CharSet = 'UTF-8';
            $mail2->isSMTP();
            $mail2->Host = 'smtp.gmail.com';
            $mail2->SMTPAuth = true;
            $mail2->Username = 'miusov86@gmail.com';
            $mail2->Password = 'V2bec1jd';
            $mail2->SMTPSecure = 'ssl';
            $mail2->Port = 465;

            $mail2->setFrom($_POST['email'], $_POST['name']);
            $mail2->addAddress('miusov86@gmail.com', 'mius');
            $mail2->isHTML(false);

            $mail2->Subject = $_POST['theme'];
            $mail2->Body    = $_POST['mess'];

            if(!$mail2->send()) {
                echo "<div class='alert-danger'>Что-то пошло не так!</div>".$mail2->ErrorInfo;
                die;
            } else {
                echo "<div class='alert-success'>Ваше сообщение успешно отправлено!</div>";
                die;
            }
        }
    }

}

