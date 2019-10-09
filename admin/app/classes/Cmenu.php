<?php
namespace app\classes;

class Cmenu extends Mmenu
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
        
		return $str;
	}
	
	// создаем новое меню
	public function post_data($post)
	{ 
		// чистим
		foreach($post as $key => $value) 
		{
			$aux_post[$key] = $this->clean_data($value) ;
		}
		// устанавливаем позицию в меню
        $this->pos_inc($aux_post['position']);

		// отправляем информацию в базу
		$this->create($aux_post) ;
    }
	
	// возвращает список всех меню (id-массив с данными)
    public function print_list($lng)
	{
        // получаем список всех меню
		$list = $this->menu_pos($lng);
        while ($row = $list->fetch())
		{
            // помещаем результат в многомерный массив
			$m[$row['id']] = $row;
        }
        return $m;
    }

	// возвращает выбранное меню для редактирования
    public function print_menuedit($id)
	{ 
        $res = $this->retr_menuedit($id);
        $row = $res->fetch();
        return $row;
    }
	
	// возвращает список меню и добавляет надпись "-в конец списка-"
    public function menu_return($last_pos, $lng)
	{
		// получаем список всех меню
        $res = $this->menu_pos($lng);
        while ($row = $res->fetch())
		{
            // заносим в новый массив
			$menu[$row['menu_name']] = $row['position'];
        }
		// добавляем в конец массива пункт "-в конец списка-"    
        if($last_pos)
		{
			$k = end($menu);
			$menu[$last_pos] = $k + 1;
        }
        return $menu;
    }
	
	// редактируем меню
    public function update_data($post)
	{
        foreach ($post as $key => $val)
		{
            // чистим
			$post[$key] = $this->clean_data($val);
        }
		
        $this->pos_inc($post['position']);
		// отправляем информацию в базу
        $this->update_menu($post);
    }
	
	// удаляем меню
    public function del_menu($id)
	{
        $res = $this->delete_menu($id);
		return $res;
    }
	
}
?>