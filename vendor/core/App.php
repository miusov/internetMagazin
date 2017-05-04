<?php

namespace vendor\core;

use vendor\core\Regestry;

class App
{
    public static $app;

    public function __construct()
    {
        self::$app = Regestry::instance();
    }
}