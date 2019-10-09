<?php
namespace app\classes;


class Cusers extends Musers
{
    public function change_authentification($post)
    {
        /**
         * @var CLogin $c_login
         */
        $c_login = Factory::getClassInst("CLogin");

        $user  = $_POST['user']; // логин
        $pass0 = $_POST['pass0']; // текущий пароль
        $pass1 = $_POST['pass1']; // новый пароль
        $pass2 = $_POST['pass2']; // повтор нового пароля

        // Если введены все данные
        if (empty($user) || empty($pass0) || empty($pass1) || empty($pass2))
        {
            die ("<center><img src='image/error.png' border=0><h4><h4>Вы ввели не всю информацию, вернитесь назад и заполните все поля!</h4><br><a href='?page=changeauth'>попытаться еще раз</a></center>");
        }

        // Чистим
        $user = $c_login->clean_login($user);
        $current_pass = $c_login->clean_password($pass0);
        $new_pass = $c_login->clean_password($pass1);
        $repeated_new_pass = $c_login->clean_password($pass2);

        // Проверяем, правильный ли текущий логин пароль и правильно ли повторно введён новый пароль
        if ($c_login->return_authorisation($user, $current_pass) && $new_pass == $repeated_new_pass)
        {
            $this->update_authentification($user, $new_pass);
        }
        else
        {
            echo "<center><img src='image/error.png' border=0><h4>Вы допустили ошибку при заполнении, вернитесь назад и попробуйте еще раз!</h4><br><a href='?page=changeauth'>попытаться еще раз</a></center>";
        }
    }
}