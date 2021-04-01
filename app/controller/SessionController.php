<?php

namespace App\Controller;

use Exception;

class SessionController
{
    //записать ключ со значением в сессию
    public static function put($name, $value) {
        return $_SESSION[$name] = $value;
    }

    //проверка на наличие ключа в сесcии
    public static function exists($name) {
        return (isset($_SESSION[$name])) ? true : false;
    }



}