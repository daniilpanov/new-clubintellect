<?php
namespace app\classes;

class Msettings
{
    // возвращает название домена
	function return_domain()
	{
        $dom = Db::getInstance()->read("constants", "domainname", array("id" => 1));
		$res = $dom->fetch();
        return $res;
    }

	// возвращает настройки сайта для языковых констант
	function return_settings($lng)
	{
        $lgs = Db::getInstance()->read("constants", "site, footer", array("language" => $lng));
		$res = $lgs->fetch();
        return $res;
	}	
	
	// проверяет включен ли язык на сайте
	function return_active_language()
	{
        $lgs = Db::getInstance()->read("languages", "visible", array("language" => $_SESSION['language']));
		$res = $lgs->fetch();
		return $res;
	}
		
	// проверяет язык на сайте по умолчанию
	function return_default_language()
	{
        $lgs = Db::getInstance()->read("languages", "language", array("default_lng" => '1'));
		$res = $lgs->fetch();
		return $res;
	}
}
?>