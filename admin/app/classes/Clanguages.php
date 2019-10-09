<?php
namespace app\classes;

class Clanguages extends Mlanguages 
{		
	// переводим спецсимволы в html сущности
	public function clean_data($str) 
	{
		if(get_magic_quotes_gpc() == 1) 
		{
			$str = str_replace('\"', "&quot;", $str) ;
			$str = str_replace("\'", "&#039;", $str) ;
			$str = str_replace("<", "&lt;", $str) ;
			$str = str_replace(">", "&gt;", $str) ;
		}
        
		return $str ;
	}
	
	// возвращает список всех языков
    public function print_languages_list($exclude)
	{
        $l=$this->language_list($exclude);
        while ($row = $l->fetch())
		{
            // помещаем результат в многомерный массив
			$m [$row['id']] = $row;
        }
        return $m;
    }
	
	// возвращает выбранный язык для редактирования
    public function print_languageedit($id)
	{ 
        $res = $this->retr_languageedit($id);
        $row = $res->fetch();
        return $row;
    }
	
	// редактируем язык
    public function update_data($post)
	{
		// отправляем информацию в базу
        $this->update_language($post);
    }
}
?>