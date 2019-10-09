<?php
ob_start();
session_start();

// автозагрузка классов
spl_autoload_register(function ($name)
{
    // конвертируем полный путь в пространстве имён с \ в /
    $name = str_replace('\\', '/', $name);

    require_once($name.'.php');
});
	
if (!isset($_POST['login']) || !isset($_POST['password']) )
{
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!--Подключаем таблицу стилей CSS-->
        <link href="../style/login.css" rel="stylesheet" type="text/css" media="screen, all" />
        <!--Конец подключения-->

        <title>Авторизация доступа</title>
    </head>
    <body>
        <div class="form_wrapper">

           <form class="login active" method="post">
            <h3>Авторизация доступа<br /></h3>
            <h2>Вход в систему управления сайтом.</h2>

                <div>
                <label>Логин:
                    <input type="text" name="login"/>
                </label>
                </div>

                <div>
                <label>Пароль:
                    <input name="password" type="password" />
                </label>
                </div>

                <input type="submit" value="Войти" />

            </form>

        </div>
    <?php
}
else
{
    $login = $_POST['login'];
    $password = $_POST['password'];

    if (empty($login) || empty($password))
    {
        die("<center><img src='../image/error.png' border=0><h4>Вы ввели не всю информацию, вернитесь назад и заполните все поля!</h4><br><a href='../index.php'>Назад</a></center>");
    }

    $check_authorisation = \app\classes\Factory::getClassInst("CLogin");

    $login = $check_authorisation->clean_login($login);
    $password = $check_authorisation->clean_password($password);

    $result = $check_authorisation->return_authorisation($login, $password);

    $user = $result->fetch();

    if ($user)
    {
        $_SESSION['loged_name'] = $user['full_name'];
        $_SESSION['loged_login'] = $user['login'];

        header('Refresh: 0; URL=index.php');
    }
    else
    {
        echo "<center><img src='../image/error.png' border=0><h4>Ошибка авторизации!</h4><br><a href='../index.php'>Назад</a></center>";
        die();
    }
}
?>