<?php
/**
 * Created by PhpStorm.
 * User: BOSSBOSS
 * Date: 29.03.2017
 * Time: 18:03
 */

namespace vendor\core;


trait TraitSingleton
{
    protected static $instance;

    public static function instance()
    {
        if (self::$instance === null)
        {
            self::$instance = new self;
        }
        return self::$instance;
    }
}