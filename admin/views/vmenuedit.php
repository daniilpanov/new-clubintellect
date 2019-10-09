<?php

<<<<<<< HEAD
use app\classes\Factory;

// ID меню
$id = $_GET['id'];

// создаём объекты
$all_menus = Factory::getClassInst("Cmenu");
$create_edit = Factory::getClassInst("Cpage");
=======
$id = $_GET['menuedit'];
>>>>>>> c24db43a18978c4688b62e3f71a1497af284d410

// получаем данные с базы о редактируемом меню
$menu = $allmenus->print_menuedit($id);

// получаем список всех языков
$all_languages = $vcreateedit->print_languages_list("");
// получаем список всех языков кроме выбранного
$exclude_language = $vcreateedit->print_languages_list($menu['language']);
?>

<form method="post">
    <input type="hidden" name="id" value="<?php echo $id;?>"/>

    <table class ="table_noborder">
    <tr>
        <td class="header_td">Редактирование меню "<?php echo $menu['menu_name'];?>"</td>
        <td class="header_td"><a href="?delete=<?php echo $id;?>" onclick='return confirm("Вы действительно хотите удалить меню <?php echo $menu['menu_name'];?>?")'><img class="right" title="удалить страницу" src="image/delete.png" /></a></td>             
    </tr>
    </table>
    
    <table class ="table_noborder">
    <tr>
		<td>язык: </td>
		<td><select name = "language" class="select">
			<?php
			foreach ($all_languages as $key => $value)
			{
                ?>
                <option value = "<?php echo $key; ?>" <?=($key == $menu['language']) ? "selected" : ""?>><?php echo $value;?></option>
                <?php
            }
            ?>
			</select>
		</td>
	</tr>
	
	<tr>
		<td>название: </td>
		<td><input type="text" name = "menu_name" size = "105" value = "<?php echo $menu['menu_name'];?>" /></td>
	</tr>
	<tr>
        <td>позиция: </td>
<<<<<<< HEAD
		<td>
            <select name = "position" class="select">
                <?php
                $allmenuslist = $all_menus->menu_return('-в конец списка-', $menu['language']);
=======
		<td><select name = "position" class="select">
                <?php $allmenuslist = $allmenus->menu_return('-в конец списка-',$menu['language']);
>>>>>>> c24db43a18978c4688b62e3f71a1497af284d410
                                                                        
                        foreach ($allmenuslist as $menu_name => $position)
						{
                            ?>
                            <option value = "<?php echo $position; ?>"<?php if($menu_name == $menu['menu_name']){echo "selected";}?>><?php echo $menu_name; ?></option>
                            <?php
                        }
                        ?>        
            </select>
		</td>
	</tr>
	<tr>					
		<td>заголовок: </td>
		<td><select name = "header_visible" class="select">
			<option value = "1" <?php if($menu['header_visible']== 1){echo "selected";}?>>отображать</option>
			<option value = "0" <?php if($menu['header_visible']== 0){echo "selected";}?>>скрыть</option>
			</select>
		</td>
	</tr>	
	<tr>					
		<td>публикация: </td>
		<td><select name = "visible" class="select">
			<option value = "1" <?php if($menu['visible']== 1){echo "selected";}?>>опубликовать</option>
			<option value = "0" <?php if($menu['visible']== 0){echo "selected";}?>>скрыть</option>
			</select>
		</td>
	</tr>	
	</table>
	<br />
	<input type="submit"  value="Сохранить">
</form>
<script type="text/javascript">
var ckeditor = CKEDITOR.replace('editor1');
</script>