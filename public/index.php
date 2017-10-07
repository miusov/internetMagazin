<?php
session_start();
error_reporting(0);

use vendor\core\Router;


require '../vendor/libs/helpers.php';
require '../vendor/autoload.php';

$query = rtrim($_SERVER['QUERY_STRING'], '/');

define('WWW', __DIR__);
define('CORE', dirname(__DIR__).'/vendor/core');
define('ROOT', dirname(__DIR__));
define('LIBS', dirname(__DIR__).'/vendor/libs');
define('APP', dirname(__DIR__).'/app');
define('CACHE', dirname(__DIR__).'/tmp/cache');
define('LAYOUT', 'default'); //шаблон по дефолту
define('COUNT_ITEM', 12);//Количество записей на странице


/**
 * функция автозагрузки классов
 */
spl_autoload_register(function ($class)
    {
        $file = ROOT.'/'.str_replace('\\','/',$class).'.php';
    if (is_file($file))
    {
        require_once $file;
    }
});

new \vendor\core\App();

Router::add('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$',['controller'=>'Page']);
Router::add('^page/(?P<alias>[a-z-]+)$',['controller'=>'Page', 'action' => 'view']);

//defaults routs
Router::add('^$',['controller'=>'Main', 'action'=>'index']);
Router::add('^(?<controller>[a-z-]+)/?(?<action>[a-z-]+)?$');

Router::dispatch($query);