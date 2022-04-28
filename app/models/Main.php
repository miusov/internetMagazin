<?php

namespace app\models;

use vendor\core\base\Model;

class Main extends Model
{
    public $table = 'tableproducts';  //указываем с какой таблицей будет работать данная модель
    public $pk = 'name';  //указываем по какому полю будет искать метод findOne(по дефолту ищет по id)
}