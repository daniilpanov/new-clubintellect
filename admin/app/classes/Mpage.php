<?php
namespace app\classes;

class Mpage
{
	// возвращает список всех страниц 
	protected function retr()
	{
        $res = Db::getInstance()->read("pages", "id, position, menu_name, language", null, false, true, null, "position");// выполняем запрос
        return $res; // возвращаем результат
    }
	
	// возвращает список всех языков
	protected function language_list($exclude)
	{
        $res = Db::getInstance()->read("languages", "*", array("language" => $exclude), false, true, null, null, "", false, "<>");// выполняем запрос
        return $res; // возвращаем результат
    }
	
	// возвращает список всех меню
	protected function menu_list($exclude, $lng)
	{ 
        //$sql = "SELECT * FROM menus WHERE id <> '{$exclude}' AND language = '{$lng}'";
        $res = Db::getInstance()->read("menus", "*", array("id" => $exclude, "language" => $lng), false, true, null, null, "", false, array("<>", "=")); // выполняем запрос
        return $res; // возвращаем результат
    }
	
	// создает новую страницу
	protected function create($post)
	{
        if ($res = Db::getInstance()->create("pages", $post, true))
        {
            echo "<p class = 'center'><img src='image/ok.png' alt='OK'>   Новая страница была успешно добавлена!</p><p class = 'center'><a class = 'links' href=''>создать еще</a>&nbsp;|&nbsp;<a class = 'links' href='?page=pagelist'>список страниц</a></p>";
        }
        else
        {
            echo "<p class = 'center'><img src='image/error.png' alt='Error'>   Возникла ошибка при добавлении новой страницы!</p>";
        }

        return $res;
	}
                
    // возвращает выбранную страницу для редактирования
    protected function retr_pageedit($id)
	{
        $res = Db::getInstance()->read("pages", "*", array("id" => $id)); // выполняем запрос
        return $res; // возвращаем результат
    }

    // редактируем страницу
    protected function update_page($post)
    {
        if ($res = Db::getInstance()->update("pages", $post, array("id" => $post['id']), true))
        {
            echo "<p class = 'center'><img src='image/ok.png' alt='OK'>   Данные были успешно изменены!</p><p class = 'center'><a class = 'links' href=''>редактировать</a>&nbsp;|&nbsp;<a class = 'links' href='?page=pagelist'>список страниц</a></p>";
        }
        else
		{
            echo "<p class = 'center'><img src='image/error.png' alt='Error'>   Возникла ошибка при изменении данных!</p>";
        }
    }

    // удаляем выбранную страницу
    protected function delete_page($id)
	{
        if (!$res = Db::getInstance()->delete("pages", array("id" => $id)))
		{
			echo "<p class = 'center'><img src='image/error.png' border=0>   Возникла ошибка при удалении страницы!</p>";	
		}

        return $res; // возвращаем результат
    }
	
	// возвращает список всех страниц со всей информацией по каждой
	protected function menu_pos($lng, $cols = "*")
	{
        $res = Db::getInstance()->read("pages", $cols, array("language" => $lng), false, true, null, "position");// выполняем запрос
        return $res; // возвращаем результат
    }
    
    // позиция в меню
	protected function pos_inc($pos)
	{
        $sql = "UPDATE pages SET position = position+1 WHERE position >= {$pos}";
        Db::getInstance()->sql($sql, null, false); // выполняем запрос
    }
}
?>
