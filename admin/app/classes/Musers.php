<?php
namespace app\classes;

class Musers
{
	// обновляем логин/пароль для входа в систему администрирования
	protected function update_authentification($login, $pass)
	{
		if ($res = Db::getInstance()->update("users", array("login" => $login, "password" => $pass), array("id" => '1')))
        {
            echo "<p class = 'center'><img src='image/ok.png' border=0>Ваши данные для входа в систему управления сайтом были успешно изменены!</p><p class = 'center'><a href='?page=changeauth'>изменить еще раз</a>&nbsp;|&nbsp;<a class = 'links' href='exit.php'>выход из системы администрирования</a></p>";
        }
        else
		{
            echo "<p class = 'center'><img src='image/error.png' border=0>Возникла ошибка при изминении данных!</p><p class = 'center'><a href='?page=changeauth'>попытаться еще раз</a></p>";
        }
    }
}
?>