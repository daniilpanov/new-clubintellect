<div id="head-container">
    <div id="header">
        <br />
        <br />
        <h1>
            Система управления сайтом
        </h1>
        <p>
            Версия от 12.01.2018
        </p>
        <!--<img class="header_admin" alt="" src="../upload/images/logo.png">-->
    </div><!--header-->
</div><!--head-container-->

<div id="navigation-container">
    <nav id="navigation">
        <a href="index.php" title="Главная"><i class="icon-home icon-large"> </i></a>
        <a href="?menu=list" title="Список меню"><i class="icon-reorder icon-large"> </i></a>
        <a href="?page=list" title="Список страниц"><i class="icon-list-ol icon-large"> </i></a>
        <a href="?reviews=list" title="Отзывы"><i class="icon-thumbs-up icon-large"> </i></a>
        <a href="?languages=list" title="Языки"><i class="icon-globe icon-large"> </i></a>
        <a href="?users=list" title="Пользователи"><i class="icon-user icon-large"> </i></a>
        <a href="?settings" title="Настройки"><i class="icon-cog icon-large"> </i></a>
        <a href="?help" title="Помощь"><i class="icon-info-sign icon-large"> </i></a>
        <a href="../index.php" title="На сайт" target="_blank"><i class="icon-reply icon-large"> </i></a>
        <a href="exit.php" title="Выход"><i class="icon-off icon-large"> </i></a>

        <div id="date">
            <?php
            $timezone = "Europe/Moscow";
            /** @var \admin\app\models\SuperDate $day */
            $day = \admin\app\Factory::createModelIfNotExists("SuperDate", ['timezone' => $timezone], [$timezone]);
            echo $day->getSuperFormattedTime() . "\n";
            ?>
        </div><!--date-->

    </nav><!--navigation-->
</div><!--navigation-container-->
