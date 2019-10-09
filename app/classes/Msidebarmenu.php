<?php
namespace app\classes;

class Msidebarmenu
{
    function return_pages($menu_number)
	{
        $res = Db::getInstance()
            ->read(
                "pages", "id, parent_id, menu_icon, icon_size, menu_name, active_link_in_sidebar",
                array("visible_in_sidebar" => "1", "menu_number" => $menu_number, "language" => $_SESSION['language']),
                false, true, null, "position"
            );
        return $res; // возвращаем результат
    }
}
?>