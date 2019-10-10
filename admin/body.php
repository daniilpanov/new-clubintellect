<?php

use app\classes\Router;
?>

<div id="content-container">
    <div id="content-container2">
        <div id="content-container3">
            <?php

            // Маршрутизатор
            if ($_POST && $_GET)
            {
                Router::postAndGet($_GET, $_POST);
            }
            elseif ($_GET)
            {
                Router::routeGET($_GET);
            }
            /*elseif ($_POST)
            {
                Router::routePOST($_POST);
            }*/
            else
            {
                Router::routeNone();
            }
            ?>
        </div><!--content-container3-->
    </div><!--content-container2-->
</div><!--content-container-->
<div class="empty">&nbsp;</div><!--empty-->
