<?php
namespace app\classes;


class Cuninstall extends Muninstall
{
    private $lng; // берётся с сессии
    private $error = ""; // сообщение об ошибке
    const CONFIG = "app/classes/Config.php";

    use Singleton;

    private function __construct()
    {
        $this->lng = ($_SESSION['language'] == null) ? "ru" : $_SESSION['language'];
    }

    public function getForm()
    {
        // Возвращаем HTML-код (форма с полем для пароля)
        return "
        <form method='post'>
            <label>
                Введите пароль: &emsp;
                <input type='password' name='password' placeholder='Пароль'>
                <button type='submit' class='btn btn-danger'>Продолжить&emsp;&rArr;</button>
            </label>
        </form>
        ";
    }

    // Проверка пароля
    public function checkPassword(string $password)
    {
        /**
         * @var $login CLogin
         */
        $login = Factory::getClassInst("CLogin"); // объект класса СLogin
        // Шифруем пароль
        $password = $login->clean_password($password);
        // Получаем с БД всю информацию о пользователе
        $user = $login->return_authorisation($_SESSION['loged_login'], $password);
        $user = $user->fetch();
        $right_password = $user['password']; // записываем пароль

        // Если пароли не совпадают, то меняем сообщение об ошибке
        if (!$res = ($password == $right_password))
        {
            $this->error = "Вы неправильно ввели пароль. Попробуйте ещё раз";
        }

        return $res;
    }

    public function getErrorMessage()
    {
        return ($this->error !== "") ? "
        <div class='alert alert-danger alert-dismissable fade show' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
            <h4 class='alert-heading'>Ошибка!</h4>
            <p>{$this->error}</p>
        </div>
        " : "";
    }

    // Удаление таблиц с БД и конф. файлов
    public function delete()
    {
        $res = true;

        $tables = $this->getAllTables(Config::DB_NAME);

        $sql = "DROP TABLE ";

        while ($table = $tables->fetch())
        {
            if (!Db::getInstance()->sql($sql.$table['Tables_in_'.Config::DB_NAME]))
            {
                $this->error .= "<br />Таблица {$table['Tables_in_new_project']} не удалена!";
                $res = false;
            }
        }

        // Если таблицы в БД удалены, то удаляем конфигурационные файлы
        if ($res)
        {
            if (!unlink(self::CONFIG)
                || !unlink("../".self::CONFIG)
                || !unlink("../.htaccess")
                || !unlink("../logs.txt")
            )
            {
                $this->error .= "<br />Файлы не удалены!";
                $res = false;
            }
        }

        return $res;
    }
}