<?php

use app\classes\Factory;

$lng = getCurrentLng();
$language = Factory::getClassInst("Clanguages")->print_languages_list("");

// получаем данные с базы о настройках
$sitesettings = Factory::getClassInst("Csettings")->return_all_settings($lng);
?>

<form method="post">
    <input type="hidden" name="id" value="<?php echo $sitesettings['id'];?>"/>
    <input type="hidden" name="language" value="<?php echo $sitesettings['language'];?>"/>

    <a href = "?page=rusettings"><img title="русская версия сайта" alt="ru" src="../upload/images/ru.png" /></a>
    <a href = "?page=ensettings"><img title="английская версия сайта" alt="en" src="../upload/images/en.png" /></a>

    <table class ="table_noborder">
    <tr>
        <td class="header_td">Основные настройки сайта для языка "<?php echo $language[1]['title'];?>"</td>            
    </tr>
    </table>
    
    <table class ="table_noborder">
	<tr>
		<td>название сайта</td>
		<td><input type="text" name="site" value="<?php echo $sitesettings['site'];?>"></td>
	</tr>
    <tr>
        <td>количество отзывов на странице</td>
        <td><input type="text" name="reviews_on_page" value="<?php echo $sitesettings['reviews_on_page'];?>"></td>
    </tr>
	<tr>
		<td>copyright</td>
		<td><input type="text" name="footer" value="<?php echo $sitesettings['footer'];?>"></td>
	</tr>
	</table>
	<br />
	<input type="submit"  value="Сохранить">
</form>
<hr>
<a href="?page=uninstall" class="btn btn-danger">Деинсталляция</a>