<?php
session_start();

if (!isset($_SESSION['loged_login']))
{
	die("Доступ на эту страницу разрешен только администратору сайта");
}
else
{
    unset($_SESSION['loged_login']);

    header('Refresh: 0; URL=../');
}

exit;
?>