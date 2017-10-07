<?php


namespace app\controllers;
use app\models\Main;
use vendor\core\base\Controller;
use R;

class AppController extends Controller
{
    public $meta = [];
    public $cat;
    public $subCat;

    protected function setMeta($title = '', $description = '', $keywords = '')  //метод для заполнения метаданных
    {
        $this->meta['title'] = $title;
        $this->meta['description'] = $description;
        $this->meta['keywords'] = $keywords;
    }
}