<?php
namespace app\classes;

class MLogin
{
    protected function return_authorisation($login, $password)
	{
        $res = Db::getInstance()->read("users", "*", array("login" => $login, "password" => $password));
        return $res;
    }
}
?>