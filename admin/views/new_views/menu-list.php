<?php
//createLanguageSwitcher("menu-list");
?>
<p>Текущий язык: <?=lngSign(getCurrentLng())?></p>

<div class="row list-header">
    <div class="col-md-3">
        Название меню
    </div>
    <div class="col-md-3">
        Создано
    </div>
    <div class="col-md-3">
        Изменено
    </div>
    <div class="col-md-2">
        Редактировать
    </div>
    <div class="col-md-1">
        Удалить&nbsp;<input type="checkbox">
    </div>
</div>

<?php

/** @var $menus \admin\app\models\Menu[] */

foreach ($menus as $item)
{
    ?>
    <div class="row list-item">
        <div class="col-md-3"><?=$item->menu_name?></div>
        <div class="col-md-3">
            <?=\admin\app\Factory
                ::createModel("SuperDate", null, false, "Europe/Moscow", "@{$item->created}")
                ->getSuperFormattedTimeStamp()
            ?>
        </div>
        <div class="col-md-3">
            <?=\admin\app\Factory
                ::createModel("SuperDate", null, false, "Europe/Moscow", "@{$item->lastmod}")
                ->getSuperFormattedTimeStamp()
            ?>
        </div>
        <div class="col-md-2">

        </div>
        <div class="col-md-1">

        </div>
    </div>
    <?php
}