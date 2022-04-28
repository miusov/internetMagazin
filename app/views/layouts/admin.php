<?php
$rev = R::count('reviews',"WHERE moderat=0");
$ord = R::count('orders',"WHERE order_confirm='no'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <?php \vendor\core\base\View::getMeta() ?>

    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <link href="/css/admin.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="wrap">
    <div class="container-fluid">
        <div class="row header">
            <div class="col-md-6">
                <h3>Панель управления</h3>
            </div>
            <div class="col-md-6">
                <p class="text-right"><a href="/admins">Администраторы</a> | <a href="/admin/logout">Выход</a></p>
                <p class="text-right">Вы - <?=$_SESSION['you']?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 left-sidebar">
                <ul class="navbar">
                    <a href="/admin"><li>Главная</li></a>
                    <a href="/adminorders?sort=no"><li>Заказы <span class="counts"><?php if ($ord > 0) echo "+".$ord ?></span></li></a>
                    <a href="/admin/tovari"><li>Товары</li></a>
                    <a href="/adminreview?sort=nomod"><li>Отзывы <span class="counts"><?php if ($rev > 0) echo "+".$rev?></span></li></a>
                    <a href="/admincategory"><li>Категории/Бренды</li></a>
                    <a href="/adminusers"><li>Клиенты</li></a>
                    <a href="/adminnews"><li>Новости</li></a>
                </ul>
            </div>
            <div class="col-md-10">
                <?= $content ?>
            </div>
        </div>
    </div>
</div>

<script src="/js/jquery3.2.0.min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
<script src="/js/jquery.validate.js"></script>
<script src="/js/jquery.cookie.js"></script>
<script src="/js/jquery-latest.js"></script>
<script src="/js/jquery.tablesorter.min.js"></script>
<script src="/js/textchange.js"></script>
<script src="/js/ckeditor/ckeditor.js"></script>
<script src="/js/admin.js"></script>
<?php
foreach ($scripts as $script)
{
    echo $script;
}
?>
</body>
</html>