<?php


namespace admin\app\models;


class View extends Model
{
    public static $path_to_views = "";
    
    public $view_name;
    
    public function __construct($view_name)
    {
        $this->view_name = $view_name;
    }

    public function render($data)
    {
        extract($data, EXTR_OVERWRITE);

        include (self::$path_to_views . $this->view_name . ".php");
    }
}