<?php

use admin\app\{controllers\Languages, controllers\Router, controllers\Site, Factory};

/**
 * Функция для преобразования массива формата [key => value]
 * в формат ['key' => key, 'value' => value]
 * @param $arr
 * @return array
 */
function keyToValue($arr)
{
    $prepared = [];

    foreach ($arr as $key => $value)
    {
        $prepared[] = ['key' => $key, 'value' => $value];
    }

    return $prepared;
}

// Создаём роутер
/** @var $router Router */
$router = Factory::getController("Router");
// Записываем namespace класса Site
$site = Site::class;
// и делаем его контроллером по умолчанию
$router->default_controller = $site;

// Страницы
$router->get()->key(null);
$router->get()->key("page")->value("(.+)", "page");
$router->get()->key("menu")->value("(.+)", "menu");
$router->get()->key("reviews")->value("(.+)", "reviews");
$router->get()->key("languages")->value("(.+)", "languages");
// ID
$router->get()->key("id")->value("([0-9]+)", "id");
// Переключение языка
$router->get(Languages::class)->key("lng")
    ->value("(.+)", "setCurrentLanguage");

// Инициализация роутинга
$router->route([
    Router::GET_REQUEST => (empty($_GET) ? [['key' => null]] : keyToValue($_GET)),
    Router::POST_REQUEST => (empty($_POST) ? [['key' => null]] : keyToValue($_POST))
]);