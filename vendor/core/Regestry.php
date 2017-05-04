<?php

namespace vendor\core;


class Regestry
{
    use TraitSingleton; //подключение паттерна singleton из трейта

    public static $objects = [];

    protected function __construct()
    {
        require ROOT.'/config/config.php';

        foreach ($config['components'] as $name => $component)
        {
            self::$objects[$name] = new $component;
        }
    }

    public function __get($name)  //магический метод, который вызывается если мы хотим вызвать не существующее свойство класса
    {
        if (is_object(self::$objects[$name]))
        {
            return self::$objects[$name];
        }
    }

    public function __set($name, $object)  //магический метод, который вызывается если мы хотим записать значение в не существующее свойство класса
    {
        if (!isset(self::$objects[$name]))
        {
            self::$objects[$name] = new $object;
        }
    }

    public function getList()  //выводит массив $objects, в котором хранятся классы из /config/config.php
    {
        echo '<pre>';
        var_dump(self::$objects);
        echo '</pre>';
    }
}