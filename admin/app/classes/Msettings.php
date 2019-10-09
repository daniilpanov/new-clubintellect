<?php
namespace app\classes;

class Msettings
{
    // возвращает название домена
	protected function return_domain()
	{
        $dom = Db::getInstance()->read("constants", "domainname", array("id" => 1));
		$res = $dom->fetch();
        return $res; // возвращаем результат
    }

	// возвращает настройки сайта для языковых констант
	protected function return_settings($lng)
    {
        $dom = Db::getInstance()->read("constants", "site, footer", array("language" => $lng));
        $res = $dom->fetch();
        return $res; // возвращаем результат
	}
	
	// возвращает все настройки сайта
	protected function return_all_settings($lng)
    {
        $dom = Db::getInstance()->read("constants", "*", array("language" => $lng));// выполняем запрос;
        $res = $dom->fetch();
        return $res; // возвращаем результат
	}
	
	// редактируем все настройки сайта
    protected function update_settings($post)
	{
		$lng = Db::getInstance()->read("languages", "language, title", array("language" => $post['language']), false, true, null, null, "", false, "!=");// выполняем запрос;;
		$res = $lng->fetch();

        if (Db::getInstance()->update("constants", $post, array("language" => $post['language'])))
        {
            echo "<p class = 'center'><img src='image/ok.png' border=0>   Данные были успешно изменены!</p><p class = 'center'><a class = 'links' href=''>редактировать</a>&nbsp;|&nbsp;<a class = 'links' href='?page=".$res["language"]."settings'>список настроек для языка \"".$res["title"]."\"</a></p>";
        }
        else
		{
            echo "<p class = 'center'><img src='image/error.png' border=0>   Возникла ошибка при изменении данных!</p>";
        }
    }
	
}
?>