<?php
namespace app\classes;

class Msearch
{
	function return_search($search)
	{/*
        $sql = "SELECT id, menu_name, content FROM pages WHERE menu_name LIKE :search OR content LIKE :search";
        $res = Db::getInstance()->sql($sql, );// выполняем запрос*/
        $res = Db::getInstance()
            ->read("pages", "id, menu_name, content", array("menu_name" => "%{$search}%", "content" => "%{$search}%"),
                false, true, null, null, "", true, "LIKE");
        return $res;
    }
}
?>