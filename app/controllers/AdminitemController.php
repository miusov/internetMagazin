<?php
namespace app\controllers;
use app\models\Main;
use R;
use vendor\core\App;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use vendor\core\base\View;
use PHPMailer\PHPMailer\PHPMailer;
use vendor\libs\Genpass;

class AdminitemController extends AppController
{
    public function indexAction()
    {
        if ($_SESSION['auth_admin'] == 'ok')
        {
            View::setMeta('Админ панель');
            $main = new Main();
            $this->layout = 'admin';



        }
        else
        {
            header('Location: /admin/login');
        }
    }

    public function addAction()
    {
        if ($_SESSION['auth_admin'] == 'ok')
        {
            View::setMeta('Админ панель - ДОБАВЛЕНИЕ');
            $main = new Main();
            $this->layout = 'admin';

            $cat = R::findAll('category');

            if (isset($_POST['add_item']))
            {
                if ($_POST['title'] && $_POST['price'] && $_POST['type'] && $_POST['brand'])
                {
                    if ($_POST['chk_new'] == 'on') $_POST['chk_new'] = 1;
                    if ($_POST['chk_sale'] == 'on') $_POST['chk_sale'] = 1;
                    if ($_POST['chk_leader'] == 'on') $_POST['chk_leader'] = 1;
                    if ($_POST['chk_visible'] == 'on') $_POST['chk_visible'] = 1;

                    $brand = R::findOne('category',"WHERE id=?",[$_POST['brand']]);
                    $gen = Genpass::gen();

                    if (empty($_FILES['upload_image']['name']))
                    {
                        $filename = '../noimage.png';
                        $img = true;
                    }
                    else
                    {
                        $filename = $gen.$_FILES['upload_image']['name'];
                    }

                    if (($_FILES['upload_image']['type'] == 'image/jpeg') || ($_FILES['upload_image']['type'] == 'image/gif') || ($_FILES['upload_image']['type'] == 'image/png'))
                    {
                        $img = true;
                    }

                        if (is_uploaded_file($_FILES['upload_image']['tmp_name']))
                    {
                        if ( $img == true )
                        {
                            $path1 = 'images/products/' .$filename;
                            move_uploaded_file($_FILES['upload_image']['tmp_name'], $path1);
                        }
                        else
                        {
                            echo "<div class='container text-center alert-danger'>Не поддерживаемый формат изображений!</div>";
                            $img = false;
                        }
                    }
                    if ($img == true)
                    {
                        R::getAll("INSERT INTO tableproducts(title,price,brand,seo_words,seo_description,mini_description,image,description,mini_features,features,link_video,created_at,new,leader,sale,visible,type_tovara,brand_id) 
                           VALUES('{$_POST['title']}','{$_POST['price']}','{$brand['brand']}','{$_POST['seo_words']}','{$_POST['seo_description']}','{$_POST['txt1']}','{$filename}','{$_POST['txt2']}','{$_POST['txt3']}','{$_POST['txt4']}','{$_POST['link_video']}','".date('Y-m-d H:i:s')."','{$_POST['chk_new']}','{$_POST['chk_leader']}','{$_POST['chk_sale']}','{$_POST['chk_visible']}','{$_POST['type']}','{$_POST['brand']}')");
                    }

                    $last = R::findLast('tableproducts');

                    if ($_FILES['file']['name'][0])
                    {
                        foreach ($_FILES['file']['name'] as $k => $v)
                        {
                            $filesnames = $gen.$_FILES['file']['name'][$k];
                            if (($_FILES['file']['type'][$k] == 'image/jpeg') || ($_FILES['file']['type'][$k] == 'image/gif') || ($_FILES['file']['type'][$k] == 'image/png'))
                            {
                                if($_FILES['file']['error'][$k] !=0)
                                {
                                    echo '<script>alert("Неправильный размер файла'.$v.'")</script>';
                                    continue;
                                }
                                if (move_uploaded_file($_FILES['file']['tmp_name'][$k], 'images/products/' .$gen.$v))
                                {
                                    $path2 = 'images/products/' . $filesnames;
                                    move_uploaded_file($_FILES['file']['tmp_name'][$k], $path2);
                                    R::getAll("INSERT INTO uploadsimages(products_id, image)
                                  VALUES('".$last['id']."','".$filesnames."')");
                                }
                            }
                            else
                            {
                                $img=false;
                                echo "<div class='container text-center alert-danger'>Не поддерживаемый формат изображений!</div>";
                            }
                        }
                    }
                    if ($img == true) echo "<div class='alert-success text-center'>Запись успешно добавлена!</div>";
                }
                else
                {
                    echo "<div class='alert-danger text-center'>Заполните поля со звездочкой * !</div>";
                }
            }

            $this->set(['cat'=>$cat]);
        }
        else
        {
            header('Location: /admin/login');
        }
    }

    public function editAction()
    {
        if ($_SESSION['auth_admin'] == 'ok')
        {
            View::setMeta('Админ панель - ИЗМЕНЕНИЕ');
            $main = new Main();
            $this->layout = 'admin';

            if (isset($_GET['item']))
            {
                $item = R::findOne('tableproducts',"id=?",[$_GET['item']]);
                $gallery = R::findAll('uploadsimages',"WHERE products_id=?",[$_GET['item']]);
            }
            if (isset($_POST['itemid']))
            {
                $item = R::findOne('tableproducts',"id=?",[$_POST['itemid']]);
                $gallery = R::findAll('uploadsimages',"WHERE products_id=?",[$_POST['itemid']]);
            }

            $cat = R::findAll('category');

            if ($item['type_tovara'] == 'mobile') $mobile = 'selected';
            if ($item['type_tovara'] == 'notebook') $notebook = 'selected';
            if ($item['type_tovara'] == 'tablet') $tablet = 'selected';

            if ($item['visible'] == 1) $cv = 'checked';
            if ($item['new'] == 1) $cn = 'checked';
            if ($item['leader'] == 1) $cl = 'checked';
            if ($item['sale'] == 1) $cs = 'checked';

            if (isset($_POST['edit_item']))
            {
                if ($_POST['title'] && $_POST['price'] && $_POST['type'] && $_POST['brand'])
                {
                    if ($_POST['chk_new'] == 'on') $_POST['chk_new'] = 1;
                    if ($_POST['chk_sale'] == 'on') $_POST['chk_sale'] = 1;
                    if ($_POST['chk_leader'] == 'on') $_POST['chk_leader'] = 1;
                    if ($_POST['chk_visible'] == 'on') $_POST['chk_visible'] = 1;

                    $brand = R::findOne('category',"WHERE id=?",[$_POST['brand']]);
                    $gen = Genpass::gen();

                    if ($item['image'] == '../noimage.png')
                    {
                        if (empty($_FILES['upload_image']['name']))
                        {
                            $filename = '../noimage.png';
                        }
                        else
                        {
                            $filename = $gen.$_FILES['upload_image']['name'];
                        }
                    }
                    else
                    {
                        $filename = $item['image'];
                    }

                    if (is_uploaded_file($_FILES['upload_image']['tmp_name']))
                    {
                        if (($_FILES['upload_image']['type'] == 'image/jpeg') || ($_FILES['upload_image']['type'] == 'image/gif') || ($_FILES['upload_image']['type'] == 'image/png'))
                        {
                            $path1 = 'images/products/' .$filename;
                            move_uploaded_file($_FILES['upload_image']['tmp_name'], $path1);
                        }
                        else
                        {
                            $alert = "<div class='container text-center alert-danger'>Не поддерживаемый формат изображений!</div>";
                        }
                    }


                    R::getAll("UPDATE tableproducts 
                               SET title='{$_POST['title']}', 
                                   price = '{$_POST['price']}', 
                                   brand = '{$brand['brand']}',
                                   seo_words = '{$_POST['seo_words']}',
                                   seo_description = '{$_POST['seo_description']}',
                                   mini_description = '{$_POST['txt1']}',
                                   image = '{$filename}',
                                   description = '{$_POST['txt2']}',
                                   mini_features = '{$_POST['txt3']}',
                                   features = '{$_POST['txt4']}',
                                   link_video = '{$_POST['link_video']}',
                                   created_at = '".date('Y-m-d H:i:s')."',
                                   new = '{$_POST['chk_new']}',
                                   leader = '{$_POST['chk_leader']}',
                                   sale = '{$_POST['chk_sale']}',
                                   visible = '{$_POST['chk_visible']}',
                                   type_tovara = '{$_POST['type']}',
                                   brand_id = '{$_POST['brand']}' 
                               WHERE id=?",[$_POST['itemid']]);

                    if ($_FILES['file']['name'][0])
                    {
                        foreach ($_FILES['file']['name'] as $k => $v)
                        {
                            $filesnames = $gen.$_FILES['file']['name'][$k];
                            if (($_FILES['file']['type'][$k] == 'image/jpeg') || ($_FILES['file']['type'][$k] == 'image/gif') || ($_FILES['file']['type'][$k] == 'image/png'))
                            {
                                if($_FILES['file']['error'][$k] !=0)
                                {
                                    echo '<script>alert("Неправильный размер файла'.$v.'")</script>';
                                    continue;
                                }
                                if (move_uploaded_file($_FILES['file']['tmp_name'][$k], 'images/products/' .$gen.$v))
                                {
                                    $path2 = 'images/products/' . $filesnames;
                                    move_uploaded_file($_FILES['file']['tmp_name'][$k], $path2);
                                }
                            }
                            else
                            {
                                $alert = "<div class='container text-center alert-danger'>Не поддерживаемый формат изображений!</div>";
                            }
                            R::getAll("INSERT INTO uploadsimages(products_id, image)
                                  VALUES('".$_POST['itemid']."','".$filesnames."')");
                        }
                    }
                    $_SESSION['mess'] = "<div class='alert-success text-center'>Измененно!</div>";
                    echo "<script>setTimeout(location.href = 'http://myshop/adminitem/edit?item={$_POST['itemid']}', 1000)</script>";
                }
                else
                {
                    $alert = "<div class='alert-danger text-center'>Заполните поля со звездочкой * !</div>";
                }
            }


            $this->set(['item'=>$item,
                        'mobile'=>$mobile,
                        'notebook'=>$notebook,
                        'tablet'=>$tablet,
                        'cv'=>$cv,
                        'cn'=>$cn,
                        'cl'=>$cl,
                        'cs'=>$cs,
                        'cat'=>$cat,
                        'gallery'=>$gallery,
                        'alert'=>$alert
                ]);
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
            $del = R::findAll('uploadsimages', "WHERE products_id=?",[$_POST['id']]);
            foreach ($del as $k=>$v)
            {
                unlink(ROOT."/public/images/products/".$v['image']);
            }

            $del2 = R::findOne('tableproducts',"WHERE id=?",[$_POST['id']]);
            if ($del2['image'] != '../noimage.png')
            {
                unlink(ROOT."/public/images/products/".$del2['image']);
            }


            $var = R::load('tableproducts', $_POST['id']);
            R::trash($var);
            $var2 = R::load('uploadsimages',"WHERE products_id=?," [$_POST['id']]);
            R::trash($var2);
            die;
        }
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
                echo "<li><a href='/admin/tovari?search_input={$v['title']}'>{$v['title']}</a></li>";
            }
        }
        die;
    }

    public function delimageAction()
    {
        $main = new Main();
        if (isset($_POST['id']))
        {
            $img = R::load('tableproducts', $_POST['id']);
            $img->image = '../noimage.png';
            R::store($img);

            unlink(ROOT."/public".$_POST['src']);
            die;
        }
    }

    public function delgalleryAction()
    {
        $main = new Main();
        if (isset($_POST['id']))
        {
            $img = R::load('uploadsimages', $_POST['id']);
            R::trash($img);

            unlink(ROOT."/public".$_POST['src']);
            die;
        }
    }
}