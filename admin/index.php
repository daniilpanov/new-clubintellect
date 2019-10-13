<?php
// Инициализируем сессии
session_start();

// Автозагрузка классов
spl_autoload_register(function ($name)
{
    $name = str_replace("admin\\", "", $name);
    // конвертируем полный путь в пространстве имён с \ в /
    $name = str_replace('\\', '/', $name);

    require_once($name.'.php');
});

use admin\app\{Factory, models\View};

// Настраиваем фабрику и модели видов
Factory::$root_namespace = "admin\\app\\";
View::$path_to_views = "views" . DIRECTORY_SEPARATOR . "new_views" . DIRECTORY_SEPARATOR;

// Подключаем скрипт с функциями
require_once "lib/functions.php";
// и скрипт с инициализацией роутинга
require_once "routing-ini.php";

// создадим основной обьект настроек
/*$site_ini = Factory::getController("Csettings");

// подключаем файл со статическими языковыми константами сайта
$lng = $site_ini->return_settings("ru");*/
require_once '../language/russian.php';

// Фронтенд:
// получаем HTML-helper
/** @var \admin\app\controllers\HTMLHelper $html_helper */
$html_helper = Factory::getController("HTMLHelper");
// начинаем формировать тег <head>
$html_helper->begin("Система управления сайтом", "ru") // начало самого документа
    ->head()->meta(null, null, null, "utf-8") // кодировка
    ->meta(null, "IE=edge", "X-UA-Compatible")
    ->meta("viewport", "width=device-width, initial-scale=1")
    ->meta("Author", "Клуб интеллектуалов")
    // стили
    ->link("style/style.css", "stylesheet")
    ->link("style/bootstrap.min.css", "stylesheet", null, "screen")
    ->link("style/jquery.lightbox-0.5.css", "stylesheet", null, "screen");
// формируем <body>
$html_helper->body()->header(function ()
    {
        //
        require_once 'header.php';
    })
    ->main(function ()
    {
        //
        require_once 'body.php';
    }, "container")
    ->footer(function ()
    {
        //
        require_once 'footer.php';
    });
// заканчиваем документ
$html_helper->end();