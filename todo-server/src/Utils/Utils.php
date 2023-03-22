<?php

namespace Todolist\Utils;

final class Utils {

    public static function debug(mixed $var) 
    {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }

    public static function json_encode(mixed $value) : string
    {
        return json_encode($value, JSON_UNESCAPED_SLASHES);
    }

}