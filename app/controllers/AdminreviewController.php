<?php
namespace app\controllers;
use app\models\Main;
use R;
use vendor\core\App;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use vendor\core\base\View;
use PHPMailer\PHPMailer\PHPMailer;


class AdminreviewController extends AppController
{
    public function indexAction()
    {
        if ($_SESSION['auth_admin'] == 'ok')
        {
        View::setMeta('ОТЗЫВЫ');
        $main = new Main();
        $this->layout = 'admin';

        $count_rev = R::count('reviews');
        $cmr = R::count('reviews',"WHERE moderat=1");
        $cnr = R::count('reviews',"WHERE moderat=0");

        if ($_GET['sort'] == 'all') $count = R::count('reviews');
        if ($_GET['sort'] == 'mod') $count = R::count('reviews',"WHERE moderat=1");
        if ($_GET['sort'] == 'nomod') $count = R::count('reviews',"WHERE moderat=0");

        $num = 5;
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
        if ($page != 1) $pstr_prev = "<li><a href='/adminreview?".$get."page=".($page - 1)."' class='pstr-prev'>&lt;</a></li>";
        if ($page != $total) $pstr_next = "<li><a href='/adminreview?".$get."page=".($page + 1)."' class='pstr-next'>&gt;</a></li>";

        if($page - 5 > 0) $page5left = "<li><a href='/adminreview?".$get."page=".($page - 5)."'>".($page - 5)."</a></li>";
        if($page - 4 > 0) $page4left = "<li><a href='/adminreview?".$get."page=".($page - 4)."'>".($page - 4)."</a></li>";
        if($page - 3 > 0) $page3left = "<li><a href='/adminreview?".$get."page=".($page - 3)."'>".($page - 3)."</a></li>";
        if($page - 2 > 0) $page2left = "<li><a href='/adminreview?".$get."page=".($page - 2)."'>".($page - 2)."</a></li>";
        if($page - 1 > 0) $page1left = "<li><a href='/adminreview?".$get."page=".($page - 1)."'>".($page - 1)."</a></li>";

        if($page + 5 <= $total) $page5right = "<li><a href='/adminreview?".$get."page=".($page + 5)."'>".($page + 5)."</a></li>";
        if($page + 4 <= $total) $page4right = "<li><a href='/adminreview?".$get."page=".($page + 4)."'>".($page + 4)."</a></li>";
        if($page + 3 <= $total) $page3right = "<li><a href='/adminreview?".$get."page=".($page + 3)."'>".($page + 3)."</a></li>";
        if($page + 2 <= $total) $page2right = "<li><a href='/adminreview?".$get."page=".($page + 2)."'>".($page + 2)."</a></li>";
        if($page + 1 <= $total) $page1right = "<li><a href='/adminreview?".$get."page=".($page + 1)."'>".($page + 1)."</a></li>";

        if ($page + 5 < $total)
        {
            $strtotal = "<li><p class='nav-point'>...</p></li><li><a href='/adminreview?".$get."page=".($total)."'>".($total)."</a></li>";
        }
        else
        {
            $strtotal = '';
        }
        if ($total > 1)
        {
            $pagin =  @$pstr_prev.@$page5left.@$page4left.@$page3left.@$page2left.@$page1left."<li><a class='pstr-active' href='/adminreview?".$get."page=".($page)."'>".($page)."</a></li>".@$page1right.@$page2right.@$page3right.@$page4right.@$page5right.$strtotal.$pstr_next;
        }

        $rev = R::findAll('reviews',"WHERE moderat=0 ORDER BY id DESC");
        if (isset($_GET['sort']))
        {
            if ($_GET['sort'] == 'all') $rev = R::findAll('reviews',"ORDER BY id DESC {$paginat}");
            if ($_GET['sort'] == 'mod') $rev = R::findAll('reviews',"WHERE moderat=1 ORDER BY id DESC {$paginat}");
            if ($_GET['sort'] == 'nomod') $rev = R::findAll('reviews',"WHERE moderat=0 ORDER BY id DESC {$paginat}");
        }
        else
        {
            $_GET['sort'] = 'nomod';
        }


        $this->set(['count_rev'=>$count_rev,
                    'cmr'=>$cmr,
                    'cnr'=>$cnr,
                    'rev'=>$rev,
                    'pagin'=>$pagin]);
        }
        else
        {
            header('Location: /admin/login');
        }

    }

    public function okreviewAction()
    {
        $main = new Main();

        if (isset($_POST['ok']))
        {
            $ok = R::load('reviews', $_POST['ok']);
            $ok->moderat = '1';
            R::store($ok);
            die;
        }
    }

    public function delreviewAction()
    {
        $main = new Main();

        if (isset($_POST['del']))
        {
            $del = R::load('reviews', $_POST['del']);
            R::trash($del);
            die;
        }
    }
}