<?php


namespace app\classes;


class Router
{
    // Обьекты
    private static 
        $create_edit, // для работы со страницами
        $all_menus, // для работы с меню
        $all_languages, // для работы с языками
        $settings, // для работы с настройками сайта
        $reviews, // для работы с отзывами
        $change_auth; // для работы с данными пользователей

    // Метод, инициализирующий все объекты
    public static function initObjects()
    {
        self::$create_edit = Factory::getClassInst("Cpage"); // для работы со страницами
        self::$all_menus = Factory::getClassInst("Cmenu"); // для работы с меню
        self::$all_languages = Factory::getClassInst("Clanguages"); // для работы с языками
        self::$settings = Factory::getClassInst("Csettings"); // для работы с настройками сайта
        self::$reviews = Factory::getClassInst("Creview"); // для работы с отзывами
        self::$change_auth = Factory::getClassInst("Cusers"); // для работы с данными пользователей
    }
    
    public static function routeGET($get)
    {
        foreach ($get as $index => $item)
        {
            switch ($index)
            {
                case "page":
                    switch ($item)
                    {
                        //////////////////////////////////////////
                        /// МЕНЮ
                        //////////////////////////////////////////

                        // Список меню
                        case "menulist":
                            require_once "views/vmenulist.php";
                            break;

                        // Создание меню
                        case "menucreate":
                            require_once "views/vmenucreate.php";
                            break;

                        // Редактирование меню
                        case "menuedit":
                            require_once "views/vmenuedit.php";
                            break;

                        // Удаление меню
                        case "menudelete":
                            self::$all_menus->del_menu($get['id']);

                            // TODO: create redirect to "index.php?page=menulist"!
                            require_once "views/vmenulist.php";
                            break;

                        //////////////////////////////////////////
                        /// СТРАНИЦЫ
                        //////////////////////////////////////////

                        // Список страниц
                        case "pagelist":
                            require_once "views/vpagelist.php";
                            break;

                        // Создание страницы
                        case "pagecreate":
                            require_once "views/vpagecreate.php";
                            break;

                        // Редактирование страницы
                        case "editpage":
                            require_once "views/vpageedit.php";
                            break;

                        // Удаление страницы
                        case "deletepage":
                            self::$create_edit->del_page($get['id']);

                            // TODO: create redirect to "index.php?page=pagelist"!
                            require_once "views/vpagelist.php";
                            break;

                        //////////////////////////////////////////
                        /// ОТЗЫВЫ
                        //////////////////////////////////////////

                        // Список отзывов
                        case "reviewslist":
                            require_once "views/reviewslist.php";
                            break;

                        // Добавить отзыв
                        case "reviewadd":

                            break;

                        // Редактировать отзыв
                        case "reviewedit":

                            break;

                        // Удалить отзыв
                        case "deletereview":

                            break;

                        //////////////////////////////////////////
                        /// ЯЗЫКИ
                        //////////////////////////////////////////

                        // Список языков
                        case "languageslist":
                            require_once "views/vlanguageslist.php";
                            break;

                        // Редактировать язык
                        case "languageedit":
                            require_once "views/vlanguageedit.php";
                            break;

                        //////////////////////////////////////////
                        /// ПРОЧЕЕ
                        //////////////////////////////////////////

                        // Настройки
                        case "settings":
                            require_once "views/vsettings.php";
                            break;

                        // Удаление
                        case "uninstall":
                            require_once "views/vuninstall.php";
                            break;

                        // Пользователи
                        case "users":
                            require_once "views/vusers.php";
                            break;

                        // Помощь
                        case "help":
                            require_once "views/vhelp.php";
                            break;
                    }
                    break;

                // Смена языка
                case "lng":
                    $_SESSION['language'] = $item;
                    break;
            }
        }
    }

    /*public static function routeGET($get)
    {
        foreach ($get as $index => $item)
        {
            switch ($index)
            {

            }
        }
    }*/

    public static function postAndGet($get, $post)
    {
        foreach ($get as $get_key => $get_item)
        {
            switch ($get_key)
            {
                // добавляем запись о новом меню в БД
                case "menu":
                    if ($get_item == "rucreate" || $get_item == "encreate")
                    self::$all_menus->post_data($post);
                    break;

                // редактируем запись о существующем меню в БД
                case "menuedit":
                    self::$all_menus->update_data($post);
                    break;

                // удаляем список выделенных меню с БД
                case "delmenu":
                    $del = $post['delmemenu'];

                    foreach($del as $key => $value)
                    {
                        $del_items[] = $value;
                    }

                    $menu = self::$all_menus->print_menuedit($del_items[0]);

                    foreach($del as $key => $value)
                    {
                        self::$all_menus->del_menu($value);
                    }

                    require_once "views/v{$menu['language']}menulist.php";
                    break;

                case "page":
                    switch ($get_item)
                    {
                        // редактируем запись о пользователе системы администрирования в БД
                        case "changeauth":
                            self::$change_auth->change_authentification($post);
                            break;

                        // основные настройки сайта
                        case "rusettings";
                        case "ensettings":
                            self::$settings->update_data($post);
                            break;

                        // добавляем запись о новой странице в БД
                        case "rucreate";
                        case "encreate":
                            self::$create_edit->post_data($post);
                            break;

                        // удаление сайта (после ввода пароля)
                        case "uninstall":
                            require_once "views/vuninstall.php";
                            break;

                        // отзывы
                        case "reviewslist":
                            self::$reviews->setFilterParams($post);
                            break;

                        // редактируем запись о существующей странице в БД
                        case "editpage":
                            self::$create_edit->update_data($post);
                            break;

                        //////////////////////////////////////////
                        /// НАСТРОЙКИ
                        //////////////////////////////////////////

                        // редактируем запись о пользователе системы администрирования в БД
                        case "users":
                            self::$change_auth->change_authentification($post);
                            break;

                        // основные настройки сайта
                        case "settings":
                            self::$settings->update_data($post);
                            break;

                        // редактируем язык
                        case "languageedit":
                            self::$all_languages->update_data($post);
                            break;
                    }
                    break;
                    
                // редактируем запись о существующей странице в БД
                case "edit":
                    self::$create_edit->update_data($post);
                    break;
                    
                // удаляем список выделенных страниц с БД
                case "delme":
                    if ($get_item === null)
                    {
                        echo "<p align='center'><img src='image/error.png' alt='Error'> Вы не выбрали страницы для удаления.</p>";
                    }
                    else
                    {
                        var_dump($del = $post['delme']);

                        foreach($del as $value)
                        {
                            self::$create_edit->del_page($value);
                        }

                        // TODO: create redirect to "index.php?page=pagelist"!
                        require_once "views/vpagelist.php";
                    }
                    break;
            }
        }
    }

    public static function routeNone()
    {
        $text = <<<HERE
                    <p>Добро пожаловать в панель управления сайтом. Здесь Вы можете добавить, отредактировать или удалить информацию на сайте с помощью соответствующих пунктов верхнего меню пенели управления. Также можно изменить параметры входа в систему управления сайтом.</p>
HERE;
        echo $text;
    }
}