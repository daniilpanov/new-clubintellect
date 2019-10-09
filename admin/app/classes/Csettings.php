<?php
namespace app\classes;

class Csettings extends Msettings
{		
	// переводим спецсимволы в html сущности
	public function clean_data($str)
	{
		if(get_magic_quotes_gpc() == 1) 
		{
			$str = htmlspecialchars($str) ;
		}
        
		return $str;
	}
	
	// редактируем настройки
    public function update_data($post)
	{
        unset($post['id']);
		
		// отправляем информацию в базу
        $this->update_settings($post);
    }

    public function return_domain()
    {
        return parent::return_domain();
    }

    public function return_settings($lng)
    {
        return parent::return_settings($lng);
    }

    public function return_all_settings($lng)
    {
        return parent::return_all_settings($lng);
    }
}
?>