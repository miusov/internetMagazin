<?php

namespace vendor\core;
use R;

class Db
{
    use TraitSingleton; //подключение паттерна singleton из трейта

    protected $pdo;
    public static $countSql = 0; //кол-во выполненых sql запросов
    public static $queries = []; //sql запросы

    protected function __construct()
    {
        require LIBS.'/rb.php';
        $db = require ROOT.'/config/config_db.php';

        R::setup($db['dsn'], $db['user'], $db['pass']);
        R::freeze(true);
//        R::fancyDebug(true);  //выводит запросы к БД

    }

    public function execute($sql, $params = [])  //возвращает кол-во sql запросов
    {
        self::$countSql++;
        self::$queries[] = $sql;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    public function query($sql, $params = [])   //возвращает массив с sql запросами
    {
        self::$countSql++;
        self::$queries[] = $sql;
        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute($params);
        if ($res !== false)
        {
            return $stmt->fetchAll();
        }
        else
        {
            return [];
        }
    }
}