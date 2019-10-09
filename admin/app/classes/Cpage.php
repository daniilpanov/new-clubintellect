<?php
namespace app\classes;

class Cpage extends Mpage
{
	// переводим спецсимволы в html сущности
	public function clean_data($str)
	{
		if(get_magic_quotes_gpc() == 1)
		{
			$str = htmlspecialchars($str);
		}
        
		return $str ;
	}

	// создаем новую страницу
	public function post_data($post)
	{
	    unset($post['create']);
		// чистим
		foreach($post as $key => $value) 
		{
			$aux_post[$key] = $this->clean_data($value) ;
		}
		// устанавливаем позицию в меню
        $this->pos_inc($aux_post['position']);
		
        $aux_post['content'] = nl2br($aux_post['content']);
		// отправляем информацию в базу
		$this->create($aux_post);
    }

    // возвращает список страниц для меню и добавляет надпись "-в конец списка-"
    public function menu_return($last_pos, $lng)
	{
		// получаем список всех страниц
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
			$menu[$last_pos] = $k+1;
        }
        return $menu;
    }
    
    // возвращает список категорий
    public function category_return($lng)
	{
		// получаем список всех категорий
        $res = $this->menu_pos($lng);
        
        // добавляем в начало массива пункт "нет"
        $menu['-нет-'] = 0;
        
        while ($row = $res->fetch())
		{
            // заносим в новый массив
			$menu[$row['menu_name']] = $row['id'];
        } 
        
        return $menu;
    }
    
	// возвращает список всех страниц (id-массив с данными)
    public function print_list($lng, $cols = "*")
	{
        // получаем список колонок всех страниц из БД
		$list = $this->menu_pos($lng, $cols);
        while ($row = $list->fetch())
		{
            // помещаем результат в многомерный массив
			$m[$row['id']] = $row;
        }
        return $m;
    }

	// возвращает выбранную страницу для редактирования
    public function print_pageedit($id)
	{ 
        $res = $this->retr_pageedit($id);
        $row = $res->fetch();
        return $row;
    }

    // редактируем страницу
    public function update_data($post)
	{
        $this->pos_inc($post['position']);
		// отправляем информацию в базу
        $this->update_page($post);
    }

    // удаляем страницу
    public function del_page($id)
	{
        $res=$this->delete_page($id);
		return $res;
    }
	
	// возвращает список всех языков
    public function print_languages_list($exclude)
	{
        $l = $this->language_list($exclude);
        
		while ($row = $l->fetch())
		{
            // заносим в новый массив
			$res[$row['language']] = $row['title'];
        }
        return $res;
    }

	// возвращает список всех меню
    public function print_menu_list($exclude,$lng)
	{
        $l = $this->menu_list($exclude,$lng);
        
		while ($row = $l->fetch())
		{
            // заносим в новый массив
			$res[$row['id']] = $row['menu_name'];
        }
        return $res;
    }
               
}
?>