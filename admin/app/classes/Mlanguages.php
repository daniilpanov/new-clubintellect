<?php
namespace app\classes;

class Mlanguages
{		
	// возвращает список всех языков
	protected function language_list($exclude)
	{
        $res = Db::getInstance()->read("languages", "*", array("language" => $exclude), false, true, null, null, "", false, "<>");// выполняем запрос
        return $res; // возвращаем результат
    }
	
	// возвращает выбранный язык для редактирования
    protected function retr_languageedit($id)
	{
        $res = Db::getInstance()->read("languages", "*", array("id" => $id));// выполняем запрос
        return $res; // возвращаем результат
    }
	
	// редактируем язык
    protected function update_language($post)
	{
        if ($res = Db::getInstance()->update("languages", $post, array("id" => $post['id'])))
        {
            echo "<p class = 'center'><img src='image/ok.png' alt=''>   Данные были успешно изменены!</p><p class = 'center'><a class = 'links' href=''>редактировать</a>&nbsp;|&nbsp;<a class = 'links' href='?page=languages'>список языков</a></p>";
        }
        else
		{
            echo "<p class = 'center'><img src='image/error.png' alt=''>   Возникла ошибка при изменении данных!</p>";
        }
    }
}
?>