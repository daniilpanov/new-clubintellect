<?php

$uninstall = \app\classes\Cuninstall::getInstance();
$content = "";

$header = "
<i class='icon-spinner icon-spin'></i>
Uninstalling...";

$del = false;

if (!$_POST['password'])
{
    $content = $uninstall->getForm();
}
else
{
    $res = $uninstall->checkPassword($_POST['password']);
    // Если пароль правильный
    if ($res)
    {
        // Удаление таблиц и конф. файлов
        if ($del = $uninstall->delete())
        {
            $header = "
            <i class='icon-check'></i>
            Вся информация с Вашего сайта удалена!
            ";
        }
    }
    else
    {
        $content = $uninstall->getForm();
    }
}
?>

<div class="container">
    <div class="jumbotron">
        <h2>
            <?=$header?>
        </h2>
    </div>
    <p>
        <?php
        echo $content;
        echo $uninstall->getErrorMessage();
        if ($del)
        {
            echo "Удаление прошло успешно!";
        }
        elseif ($_POST)
        {
            echo "При удалении что-то пошло не так";
        }
        ?>
    </p>
</div>