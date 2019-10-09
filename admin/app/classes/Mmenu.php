<?php
namespace app\classes;

class Mmenu
{
	// возвращает список всех меню со всей информацией по каждому
	protected function menu_pos($lng)
	{
        $res = Db::getInstance()->read("menus", "*", array("language" => $lng), false, true, null, "position");// выполняем запрос
        return $res; // возвращаем результат
    }
	
	// создает новое меню
	protected function create($post)
	{
        if ($res = Db::getInstance()->create("menus", $post, true))
        {
            echo "<p class = 'center'><img src='image/ok.png' border=0>   Новое меню успешно добавлено!</p><p class = 'center'><a class = 'links' href=''>создать еще</a>&nbsp;|&nbsp;<a class = 'links' href='?page=".$post['language']."menulist'>список меню</a></p>";
        }
        else
        {
            echo "<p class = 'center'><img src='image/error.png' border=0>   Возникла ошибка при добавлении нового меню!</p>";
        }

        return $res;
	}
	
	// возвращает выбранное меню для редактирования
    protected function retr_menuedit($id)
	{
        $res = Db::getInstance()->read("menus", "*", array("id" => $id));// выполняем запрос
        return $res; // возвращаем результат
    }
	
	// редактируем меню
    protected function update_menu($post)
	{
        $id = $post['id'];
        unset($post['id']);

        if (Db::getInstance()->update("menus", $post, array("id" => $id), true))
        {
            echo "<p class = 'center'><img src='image/ok.png' border=0>   Данные были успешно изменены!</p>
                <p class = 'center'><a class = 'links' href=''>редактировать</a>&nbsp;|&nbsp;<a class = 'links' href='?page=".$post['language']."menulist'>список меню</a></p>";
        }
        else
		{
            echo "<p class = 'center'><img src='image/error.png' border=0>   Возникла ошибка при изменении данных!</p>";
        }
    }
	
	// удаляем выбранное меню
    protected function delete_menu($id)
	{
        if (!$res = Db::getInstance()->delete("menus", array("id" => $id)))
		{
			echo "<p class = 'center'><img src='image/error.png' border=0>   Возникла ошибка при удалении меню!</p>";	
		}

        return $res; // возвращаем результат
    }
	
	// позиция
	protected function pos_inc($pos)
	{
        $sql = "UPDATE menus SET position = position+1 WHERE position >= {$pos}";
        Db::getInstance()->sql($sql, null, false); // выполняем запрос
    }
}
?>