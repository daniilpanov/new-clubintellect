<div class="list pages">
    <div class="row list-header">
        <div class="col-7">Название</div>
        <div class="col-2">Редактирование</div>
        <div class="col-2">Удаление</div>
        <div class="col-1">
            <label><input type='checkbox' id="select-all"></label>
        </div>
    </div>
    <?php

    /** @var $pages \admin\app\models\Page[] */

    foreach ($pages as $page)
    {
        $add_class = ((int)($page->visible) > 0) ? "" : " disabled";
        echo "<div class='row'>";
        echo "<div class='col-7$add_class'>{$page->name}</div>";
        echo "<div class='col-2'>";
        echo "<a class='edit glyphicon-edit glyphicon' title='Редактировать' href='?page=edit&id={$page->id}'></a>";
        echo "</div>";
        echo "<div class='col-2'>";
        echo "<button type='submit' name='page-delete' value='{$page->id}' title='Удалить'>";
        echo "<i class='delete glyphicon-trash glyphicon'></i>";
        echo "</button>";
        echo "</div>";
        echo "<div class='col-1'>";
        echo "<input type='checkbox' name='selected-pages[]' value='{$page->id}'>";
        echo "</div>";
        echo "</div>";
    }
    ?>
</div>
