<form method="post">
    <input type="hidden" name="language" value="ru">
    <table class ="table_noborder">
        <tr>
            <td colspan="2" class="header_td">Добавление нового меню</td>
        </tr>
        <tr>
            <td>название: </td>
            <td><input type="text" name="menu_name" size="105" /></td>
        </tr>
        <tr>
            <td>позиция: </td>
            <td><select name="position" class="select">
                    <?php
                    $allmenuslist = \app\classes\Factory::getClassInst("Cmenu")->menu_return('-в конец списка-', 'ru');
                    $max = count($allmenuslist);
                    $counter = 0;

                    foreach ($allmenuslist as $menu_name => $position)
                    {
                        $counter++;
                        if($counter != $max)
                        {
                            ?>
                            <option value="<?=$position?>"><?=$menu_name?></option>
                            <?php
                        }
                        else
                        {
                            ?>
                            <option value="<?=$position?>" selected><?=$menu_name?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>заголовок: </td>
            <td>
                <select name="header_visible" class="select">
                    <option value="1" selected>отображать</option>
                    <option value="0">скрыть</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>публикация: </td>
            <td>
                <select name="visible" class="select">
                    <option value="1" selected>опубликовать</option>
                    <option value="0">скрыть</option>
                </select>
            </td>
        </tr>
	</table>

	<br>

    <button type="submit">Сохранить</button>
</form>