<!doctype html>
<html lang="ru">
<!---->
<head>
    <!--Meta-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" content="<Клуб интеллектуалов" />
    <!--End Meta-->

    <title>Система управления сайтом</title>

    <!--CSS-->
    <link href="style/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="style/style.css" rel="stylesheet" />
    <link href="style/jquery.lightbox-0.5.css" rel="stylesheet" />
    <!--End CSS-->

    <!--Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Marck+Script&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <!--End Fonts-->

    <!--Favicon-->
    <link rel="shortcut icon" href="../favicon.ico" />
    <!--End Favicon-->

    <!--Java scripts-->
    <script type="text/javascript" src="js/jquery/jquery-1.7.2.js"></script>
    <script type="text/javascript" src="js/jquery/jquery.lightbox-0.5.js"></script>
    <script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="js/Djenx.Explorer/djenx-explorer.js"></script>
    <!--End Java scripts-->

    <!--bootstrap-->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!--End Bootstrap-->
</head>

<!---->
<body>
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

// Фронтенд сайта:
// заголовок (название, меню и др.)
echo "<header>";
require_once 'header.php';
echo "</header>";
// контент (виды)
echo "<main class='container'>";
require_once 'body.php';
echo "</main>";
// и подвал (копирайт, разработчики и др.)
echo "<footer>";
require_once 'footer.php';
echo "</footer>";

?>
</body>
</html>