<?php
//

/**
 *
 */
function createLanguageSwitcher($page)
{
    ?>
    <!-- Language Switcher -->
    <a href="?page=<?=$page?>&lng=ru"><img title="русская версия сайта" alt="ru" src="../upload/images/ru.png"></a>
    <a href="?page=<?=$page?>&lng=en"><img title="английская версия сайта" alt="en" src="../upload/images/en.png"></a>
    <?php
}

/**
 *
 */
function createButtonForAdding($section, $lng, $title_section)
{
    ?>
    <!-- Button for creating <?=$section?> (language - <?=$lng?>) -->
    <a href="?page=<?=$section?>create&lng=<?=$lng?>" title="Добавить <?=$title_section?>" class="create">
        <i class="icon-plus-sign icon-large"></i>
    </a>
    <?php
}

function getCurrentLng()
{
    if (isset($_GET['lng']))
    {
        return $_GET['lng'];
    }
    elseif (isset($_SESSION['language']) && $_SESSION['language'] !== null)
    {
        return $_SESSION['language'];
    }

    return "ru";
}