<?php
//
$aux_list = \app\classes\Factory::getClassInst("Cpage");
//
$lng = (isset($_GET['lng'])) ? $_GET['lng'] : $_SESSION['language'];
//
$list = $aux_list->print_list($lng);
?>

<!-- Выборка страниц -->
<script>
    $(document).ready(function()
    {
        $("#maincheck").click(function()
        {
            $('.mc').attr('checked', $('#maincheck').attr('checked'));
        });
    });
</script>

<?php
// Добавляем переключатель языков
createLanguageSwitcher("pagelist");
// Добавляем кнопку для добавления страниц
createButtonForAdding("page", $lng, "страницу");
?>

<form method="post">
    <!-- Таблица со страницами -->
    <table class="table_page_list">
        <tr class="table_header">
            <td class="text_align_left">Название страницы</td>
            <td>Язык</td>
            <td>Создана</td>
            <td>Изменена</td>
            <td>Редактировать</td>
            <td>Удалить</td>
            <td><input title="отметить все" type="checkbox" name="maincheck" id="maincheck" class="checkbox"/></td>
        </tr>
        <?php
        foreach($list as $id => $menu_name)
        {
            ?>
            <tr>
                <td class="links">
                    <i class="<?php echo $menu_name['menu_icon'];?> icon-1x"></i>
                    <a title="редактировать" href="?page=editpage&id=<?=$id?>">
                        <?=$menu_name['menu_name']?>
                    </a>
                </td>
                <td>
                <?php
                    if ($menu_name['language'] =="ru")
                    {
                        echo'<img title="русский" alt="ru" src="../upload/images/ru.png">';
                    }
                    else
                    {
                        echo'<img title="английский" alt="en" src="../upload/images/en.png">';
                    }

                ?>
                </td>
                <td><?=date("d.m.Y \в H:i:s", $menu_name['created'])?></td>
                <td>
                    <?php
                    if(!empty($menu_name['lastmod']))
                    {
                        echo date("d.m.Y \в H:i:s", $menu_name['lastmod']);
                    }
                    else
                    {
                        echo "нет изменений";
                    }
                    ?>
                </td>
                <td><a href="?edit=<?php echo $id;?>"><img title="редактировать" src="image/edit.png" alt="Редактировань"></a></td>
                <td>
                    <a href="?page=editpage&id=<?=$id?>">
                        <img title="редактировать" src="image/edit.png" alt="Редактировань">
                    </a>
                </td>
                <td>
                    <a href="?page=deletepage&id=<?=$id?>"
                       onclick='return confirm("Вы действительно хотите удалить страницу <?=$menu_name['menu_name']?>?")'>
                        <img title="удалить" src="image/delete.png" alt="Delete">
                    </a>
                </td>
                <td>
                    <label>
                        <input title="отметить" type="checkbox" name="delme[]"  value="<?php echo $id;?>" class="mc checkbox">
                    </label>
                </td>
            </tr>
            <?php
        }
        ?>

        <tr>
            <td></td><td></td><td></td><td></td><td></td><td></td>
            <td>
                <label>
                    <button title="удалить отмеченные" type="submit" name="submit" class="delete-selected"
                            onclick='return confirm("Вы действительно хотите удалить выделенные страницы?")'>
                        <img src="image/delete.png" alt="Delete Selected">
                    </button>
                </label>
            </td>
        </tr>

    </table>
</form>