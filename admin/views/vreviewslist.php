<?php
//
$filter = $reviews->returnValuesForFilter();
// Текущий язык
$lng = (isset($_GET['lng'])) ? $_GET['lng'] : $_SESSION['language'];

// Добавляем переключатель языков
createLanguageSwitcher("reviewslist")
?>

<form method="post">
    <table class="table_page_list">
        <!-- Фильтр -->
        <tr class="table_header">
            <td class="text_align_center">
                <?php
                createButtonForAdding("reviews", $lng, "отзыв");
                ?>
            </td>
            <td class="text_align_center">
                Страница<br>
                <select name="page_id" class="select">
                    <option value="all" selected>
                        Все страницы
                    </option>

                    <?php
                    foreach ($filter["pages"] as $page_id => $page_name)
                    {
                        echo "<option value='{$page_id}'>{$page_name}</option>";
                    }
                    ?>
                </select>
            </td>
            <td class="text_align_center">
                Статус<br>
                <select name = "state"  class="select">
                    <option value="0">Опубликован</option>
                    <option value="1">На модерации</option>
                </select>
            </td>
            <td class="text_align_center">
                <label>От<br><input type="date" placeholder="от" name="created[from]"></label>
            </td>
            <td class="text_align_center">
                <label>До<br><input type="date" placeholder="до" name="created[to]"></label>
            </td>
            <td>
                <button class="search" type="submit">
                    <i class="icon icon-search"></i>
                </button>
            </td>
        </tr>

        <!-- Заголовки -->
        <tr class="table_header">
            <td>Название отзыва</td>
            <td>Название страницы</td>
            <td>Статус</td>
            <td>Сохранено</td>
            <td>Изменено</td>
            <td>
                <img title="редактировать" src="image/edit.png" alt="Редактировать">
                <img title="удалить" src="image/delete.png" alt="Удалить">
            </td>
        </tr>

        <!-- Список отзывов -->
        <?php
        $all_reviews = $reviews->getReviewsFromDB();

        foreach ($all_reviews as $review)
        {
            ?>
            <tr>
                <td><?=$review['name']?></td>
                <td><?=$filter['pages'][$review['page_id']]?></td>
                <td>
                    <?=($review['state'] == "good")
                        ? "Опубликован"
                        : "На модерации"
                    ?>
                </td>
                <td><?=date("d.m.Y \в H:i:s", $review['created'])?></td>
                <td>
                    <?=($review['lastmod'] != 0)
                        ? date("d.m.Y \в H:i:s", $review['lastmod'])
                        : "нет изменений"
                    ?>
                </td>
                <td>
                    <a href="?reviewedit=<?=$review['id']?>"><img title="редактировать" src="image/edit.png" alt="Редактировать"></a>
                    <a href="?reviewdelete=<?=$review['id']?>"><img title="удалить" src="image/delete.png" alt="Удалить"></a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
</form>