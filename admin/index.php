<?php

use app\classes\{Factory, Router};

session_start();

if (!isset($_SESSION['loged_login']))
{
	require_once "views/vlogin.php";
}
else
{
    // Автозагрузка классов
    spl_autoload_register(function ($name)
    {
        // конвертируем полный путь в пространстве имён с \ в /
        $name = str_replace('\\', '/', $name);

        require_once($name.'.php');
    });

    // Подключаем скрипт с функциями
    require_once "lib/functions.php";

    // Инициализируем все объекты в роутере
    Router::initObjects();

    // создадим основной обьект настроек
    $site_ini = Factory::getClassInst("Csettings");

    // подключаем файл со статическими языковыми константами сайта
    $lng = $site_ini->return_settings("ru");
    require_once '../language/russian.php';

    require_once 'header.php';
    require_once 'body.php';
    require_once 'footer.php';
}

?>