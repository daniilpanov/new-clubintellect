<?php
//

/**
 *
 */
function createLanguageSwitcher($page)
{
    ?>
    <!-- Language Switcher -->
    <a href="?page=<?=$page?>&lng=ru"><?=lngSign("ru")?></a>
    <a href="?page=<?=$page?>&lng=en"><?=lngSign("en")?></a>
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

function lngSign($lng)
{
    $version = "";

    switch ($lng)
    {
        case "ru":
            $version = "русская";
            break;

        case "en":
            $version = "английская";
            break;
    }

    return "<img title='$version версия сайта' alt='$lng' src='../upload/images/$lng.png'>";
}