<?php

namespace Todolist\Utils;

final class Utils {

    public static function debug(mixed $var) 
    {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }

}