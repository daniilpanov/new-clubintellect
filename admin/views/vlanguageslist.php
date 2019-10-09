<?php

use app\classes\Clanguages;

$ll = new Clanguages();
$list = $ll->print_languages_list("");
?>
<table class="table_page_list">
<tr class="table_header">
    <td class="text_align_left">Язык</td>
	<td>Флаг</td>
    <td>Статус</td>
    <td>Основной язык сайта</td>
    <td>Редактировать</td>
</tr>
<?php
foreach($list as $key => $value):
?>

    <tr>
        <td class="links">
            <a title="редактировать" href="?page=languageedit&id=<?=$value['id']?>">
                <?=$value['title']?>
            </a>
        </td>
		<td>
		<?php 
			if ($value['language']=="ru")
			{
				echo '<img title="русский" alt="ru" src="../upload/images/ru.png">';
			}
			else
			{
				echo'<img title="английский" alt="en" src="../upload/images/en.png">';
			}
				
		?>
		</td>
        <td>
		<?php 
			if ($value['visible'])
			{
				echo'включен';
			}
			else
			{
				echo'отключен';
			}
				
		?>
		</td>   
		<td>
		<?php 
			if ($value['default_lng'])
			{
				echo'да';
			}
			else
			{
				echo'нет';
			}
		?>
		</td>  
		<td>
            <a href="?page=languageedit&id=<?=$value['id']?>">
                <img title="редактировать" src="image/edit.png" alt="Редактировать">
            </a>
        </td>
    </tr>
<?php endforeach;?>

</table>