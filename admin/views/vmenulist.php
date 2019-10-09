<script>
    $(document).ready( function() {
        $("#maincheck").click( function() {
            if($('#maincheck').attr('checked')){
                $('.mc').attr('checked', true);
            } else {
                $('.mc').attr('checked', false);
            }
        });
    });
</script>

<?php
$lng = getCurrentLng();

$menu_list = \app\classes\Factory::getClassInst("Cmenu")->print_list($lng);

// Добавляем языковой переключатель
createLanguageSwitcher("menulist");
// Добавляем кнопку для создания меню
createButtonForAdding("menu", $lng, "меню");
?>

<form method="post">
    <table class="table_page_list">
        <tr class="table_header">
            <td class="text_align_left">Название меню</td>
            <td>Язык</td>
            <td>Создано</td>
            <td>Изменено</td>
            <td>Редактировать</td>
            <td>Удалить</td>
            <td>
                <label for="maincheck"></label>
                <input title="отметить все" type="checkbox" name="maincheck" id="maincheck" class="checkbox">
            </td>
        </tr>
        <?php
        foreach($menu_list as $id => $menu_name)
        {
            ?>
            <tr>
                <td class="links">
                    <a title="редактировать" href="?page=menuedit&id=<?=$id?>">
                        <?=$menu_name['menu_name']?>
                    </a>
                </td>
                <td>
                    <img title='русский' alt='ru' src='../upload/images/<?=$menu_name['language']?>.png'>
                </td>
                <td>
                    <?=date("d.m.Y \в H:i:s", $menu_name['created'])?>
                </td>
                <td>
                    <?php
                    if(!empty($menu_name['lastmod']))
                    {
                        echo date("d.m.Y \в H:i:s",$menu_name['lastmod']);
                    }
                    else
                    {
                        echo "нет изменений";
                    }
                    ?>
                </td>
                <td>
                    <a href="?page=menuedit&id=<?=$id?>">
                        <img title="редактировать" src="image/edit.png" alt="Edit">
                    </a>
                </td>
                <td>
                    <a href="?page=menudelete&id=<?=$id?>"
                       onclick='return confirm("Вы действительно хотите удалить меню <?=$menu_name['menu_name']?>?")'>
                        <img title="удалить" src="image/delete.png" alt="Delete"/>
                    </a>
                </td>
                <td>
                    <label>
                        <input title="отметить" type="checkbox" name="delmemenu[]"  value="<?=$id?>" class="mc checkbox">
                    </label>
                </td>
            </tr>
        <?php
    }
?>
<!--<table class="table_page_list">
<tr class="table_header">
	<a href = "?page=rumenulist"><img title="русская версия сайта" alt="ru" src="../upload/images/ru.png" /></a>
	<a href = "?page=enmenulist"><img title="английская версия сайта" alt="en" src="../upload/images/en.png" /></a>
	<a href = "?menu=<?php /*echo $lng [0];*/?>create" title="Добавить меню" class="mysubmenu"><i class="icon-plus-sign icon-large mysubmenu"> </i></a>
    <td class="text_align_left">Название меню</td>
    <td>Язык</td>
    <td>Создано</td>
    <td>Изменено</td>
    <td>Редактировать</td>
    <td>Удалить</td>
    <td><input title="отметить все" type="checkbox" name="maincheck" id="maincheck" class="checkbox"/></td>
</tr>
<?php
/*foreach($menulist as $id => $menu_name)
{
    */?>
    <tr>
        <td class="links"><a title="редактировать" href="?menuedit=<?php /*echo $id;*/?>"> <?php /*echo $menu_name['menu_name'];*/?></a></td>
		<td>
		<?php /*
			if ($menu_name['language'] == "ru")
			{
				echo'<img title="русский" alt="ru" src="../upload/images/ru.png">';
			}
			else
			{
				echo'<img title="английский" alt="en" src="../upload/images/en.png">';
			}
				
		*/?>
		</td>
        <td><?php /*echo date("d.m.Y \в H:i:s",$menu_name['created']);*/?></td>
        <td>
            <?php
/*            if(!empty($menu_name['lastmod']))
            {
                echo date("d.m.Y \в H:i:s",$menu_name['lastmod']);  
            }
            else
            {
                echo "нет изменений";
            }
            */?>
        </td>
		<td><a href="?menuedit=<?php /*echo $id;*/?>"><img title="редактировать" src="image/edit.png"  alt=""/></a></td>
		<td><a href="?menudelete=<?php /*echo $id;*/?>" onclick='return confirm("Вы действительно хотите удалить меню <?php /*echo $menu_name[menu_name];*/?>?")'><img title="удалить" src="image/delete.png" /></a></td>
		<td><input title="отметить" type="checkbox" name="delmemenu[]"  value="<?php /*echo $id;*/?>" class="mc checkbox" /></td>
    </tr>
    <?php
/*};
*/?>-->

<tr>
	<td></td><td></td><td></td><td></td><td></td><td></td>
	<td><input title="удалить отмеченные" type="image" name="submit" src="image/delete.png" onclick='return confirm("Вы действительно хотите удалить выделенные меню?")'  alt=""/></td>
</tr>

</table>
</form>