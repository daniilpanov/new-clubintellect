<?php
namespace app\classes;

class Mmenu
{
    protected function return_menu()
	{
        $res = Db::getInstance()
            ->read("pages", "id, parent_id, menu_icon, icon_size, menu_name",
                array("visible_in_main_menu" => "1", "language" => $_SESSION['language']),
                false, true, null, "position");
        return $res; // возвращаем результат
    }
}
