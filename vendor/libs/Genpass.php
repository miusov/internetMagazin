<?php

namespace vendor\libs;


class Genpass
{
    public static function gen()
    {
        $number = 10;

        $arr = [
            'a','b','c','d','e','f','g','h','i','j','k','l',
            'm','n','o','p','q','r','s','t','u','v','x','y',
            'z','1','2','3','4','5','6','7','8','9','0',
            'A','B','C','D','E','F','G','H','I','J','K','L',
            'L','M','N','O','P','Q','R','S','T','U','V','X'.'Y','Z'
        ];

        $pass = '';

        for($i=0; $i < $number; $i++)
        {
            $index = rand(0, count($arr)-1);
            $pass .= $arr[$index];
        }
        return $pass;
    }
}