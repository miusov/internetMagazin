<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php \vendor\core\base\View::getMeta() ?>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link href="/css/trackbar.css" rel="stylesheet">
    <link href="/css/jquery.bxslider.min.css" rel="stylesheet">
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/normalize.css" rel="stylesheet">
    <link href="/css/ion.tabs.css" rel="stylesheet">
    <link href="/css/ion.tabs.skinBordered.css" rel="stylesheet">
    <link href="/js/fancybox/dist/jquery.fancybox.min.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div id="wrap">
        <div class="container-fluid">
            <div class="row header-top">
                <div class="col-md-12">
                    <?php if (!isset($_SESSION['login']))
                    {
                        ?>
                    <div class='col-md-12 auth text-right'>
                        <span class='login' id='login'>Войти</span>
                        <div class='block-login text-left'>
                            <form action='/auth/login' method='post'>
                                <ul id='input-email-pass'>
                                    <h3>Вход</h3>
                                    <li>
                                        <input type='text' placeholder='Логин' name='login'>
                                        <input type='password' placeholder='Пароль' name='pass'>
                                    </li>
                                    <ul id='list-auth'>
                                        <li><a href='#' id='remindpass'>Забыли пароль?</a></li>
                                    </ul>
                                    <p class='text-right' id='button-auth'>
                                        <button type='submit' name='auth-user'>Войти</button>
                                    </p>
                                </ul>
                            </form>
                        </div>
                        <div class="remindpass text-left">
                            <form method="post">
                                <h4>Восстановление пароля</h4>
                                <div id="remEmail"></div>
                                <input type="email" name="rem" id="rem" placeholder="Ваш Email">
                                <div class="row">
                                <div class="col-md-6"><span id="back">Назад</span></div>
                                    <div class="col-md-6 text-right"><span id="remindpass-btn">Готово</span></div>
                                </div>
                            </form>
                        </div>
                        <span>&nbsp&nbsp|&nbsp&nbsp</span>
                        <a href='/auth/registration'>Регистрация</a>
                    </div>
                    <?php
                    }
                    else{
                        ?>
                    <div class='col-md-12 auth text-right'>
                        <span>Здравствуйте <?=$_SESSION['name']?></span>
                        <span>&nbsp&nbsp|&nbsp&nbsp</span>
                        <span class='profile'><a href='/user?name=<?=$_SESSION['login']?>'>Профиль</a></span>
                        <span>&nbsp&nbsp|&nbsp&nbsp</span>
                        <span class='exit'><a href='/auth/logout'>Выйти</a></span>
                    </div>
                    <?php
                    }?>
                </div>
            </div>
            <div class="row header">
                <div class="col-md-4 col-sm-3 hidden-xs hidden-sm header-info">
                    <p>+3 8 (097) 123 45 67</p>
                    <p>+3 8 (097) 123 45 67</p>
                </div>
                <div class="col-md-4 col-sm-6 header-logo text-center">
                    <a href="/">
                        <img src="/images/logo.png" alt="logo" width="100%">
                    </a>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 header-cart-and-search">
                    <div class="search">
                        <form action="/main" method="get">
                            <div class="input-group">
                                <input type="text" name="search_input" placeholder="Поиск..." id="input-search" class="form-control">
                                <ul id="result-search" class="text-left"></ul>
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit" name="search" value="Найти">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </div>

<!--                                <input type="submit" name="search" value="Найти" class="btn btn-default">-->
                            </div>
                        </form>
                    </div>

                    <div class="cart text-right">
                        <div class="cart-block">
                            <p id="cart-link"></p>
                            <a href="/cart?action=onclick">Оформить заказ</a>
                        </div>
                        <div class="icon-cart">
                            <span class="glyphicon glyphicon-shopping-cart"></span>
                        </div>
                    </div>

                </div>
            </div>
<div class="row row-nav">
            <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav text-center">
                            <li><a href="/">Главная</a></li>
                            <li><a href="/main?go=new">Новинки</a></li>
                            <li><a href="/main?go=leader">Лидеры продаж</a></li>
                            <li><a href="/main?go=sale">Распродажа</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
</div>

        </div>
        <div class="container-fluid">
            <div class="row page">
                <div class="col-sm-4 col-md-3 left-sidebar">
                    <div class="category-items">
                        <p class="category-items-title">Категории</p>
                        <?php
                        $c = R::findAll('category');
                        $i = 1;
                        foreach ($c as $k => $v)
                        {
                            $i++;
                            echo "
                            <p class='cat-link' id='cat".$i."'>".$v['type']."</p>
                            <ul>
                            <a href='/main?type=".$v['type']."'><li id='sub-cat1'><b>Все товары этой категории</b></li></a>
                            ";
	                        $b = R::findAll('brand','WHERE cat_id=?',[$v['id']]);
	                        foreach ($b as $key => $value)
                            {
	                            echo "<a href='/main?brand=".$value['brand']."&type={$v['type']}'> <li id='{$value['id']}'>{$value['brand']}</li></a>";
                            }

                            echo "</ul>";
                        }
                        ?>
                    </div>
                    <div class="search-in-param hidden-xs">
                        <p class="category-items-title">Поиск по параметрам</p>
                        <p class="title-filter">Стоимость</p>
                        <form action="/main" method="get">
                            <div id="block-input-price">
                                <ul>
                                    <li>От</li>
                                    <li><input type="text" name="start_price" id="start-price" value="<?php echo $start_price ?>"></li>
                                    <li>До</li>
                                    <li><input type="text" name="end_price" id="end-price" value="<?php echo $end_price ?>"></li>
                                    <li>грн.</li>
                                </ul>
                            </div>
                            <div id="trackbar"></div>
                            <p class="title-filter">Производители</p>
                            <ul class="checkbox-brand">
                                <?php
                                $cat = R::findAll('category', 'type="mobile"');
                                foreach ($cat as $k=>$v)
                                {
                                    $checked_brands = '';
                                    if (isset($_GET['brands']))
                                    {
                                        if (in_array($v['id'],$_GET['brands']))
                                        {
                                            $checked_brands = 'checked';
                                        }
                                    }
                                    echo "
                                        <li><input type='checkbox' name='brands[]' value='{$v['id']}' id='checkbarand{$v['id']}' $checked_brands>
                                            <label for='checkbarand{$v['id']}'>{$v['brand']}</label>
                                        </li>
                                    ";
                                }
                                ?>
                            </ul>
                            <input type="submit" name="submit" id="button-param-search" value="Найти">
                        </form>
                    </div>
                    <div class="hidden-xs">
                    <div id="news-slide">
                        <ul id="ns">
                           <?php
                           $news = R::findAll('news', 'ORDER BY date DESC');
                           foreach ($news as $k=>$v)
                           {
                               echo "<li id='news{$v['id']}'>
                                           <p class='news-title'>{$v['title']}</p>
                                           <p class='news-text'>{$v['text']}</p>
                                           <p class='news-date text-right'>{$v['date']}</p>
                                    </li>";
                           }
                           ?>
                        </ul>
                    </div>
                    </div>
                </div>
                <div class="col-sm-8 col-md-9 content">
                    <? echo $content ?>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row footer">
                <div class="container">
                    <a href="/main/contacts">Контакты</a>
                </div>
            </div>
        </div>
    </div>


    <script src="/js/jquery3.2.0.min.js"></script>
    <script src="/js/fancybox/dist/jquery.fancybox.min.js"></script>
    <script src="/js/jquery.bxslider.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script src="/js/jquery.cookie.js"></script>
    <script src="/js/jquery.trackbar.js"></script>
    <script src="/js/jquery.form.js"></script>
    <script src="/js/jquery.validate.js"></script>
    <script src="/js/textchange.js"></script>
    <script src="/js/ion.tabs.min.js"></script>
    <script src="/js/script.js"></script>



<?php
foreach ($scripts as $script)  //цикл выводит все скрипты перед закрывающим тегом body, которые находятся в виде(сделано для того чтобы скрипты вставлялись после jQuery и других скриптов)
{
    echo $script;
}
?>
</body>
</html>