<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <?php \vendor\core\base\View::getMeta() ?>

    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>


<? echo $content ?>


<script src="/js/jquery3.2.0.min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
<script src="/js/jquery.validate.js"></script>
<script src="/js/jquery.cookie.js"></script>
<script src="/js/admin.js"></script>
<?php
foreach ($scripts as $script)
{
    echo $script;
}
?>
</body>
</html>