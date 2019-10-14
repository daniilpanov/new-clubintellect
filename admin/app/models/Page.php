<?php


namespace admin\app\models;


use admin\app\models\Db\Query;

class Page extends Model
{
    public $id;
    public $name;
    public $title;
    public $parent_page;
    public $position;
    public $description;
    public $keywords;
    public $icon;
    public $menu_id;
    public $content;
    public $language;
    public $created;
    public $last_mod;
    public $visible;
    public $is_link;
    public $reviews;
    public $contacts;

    public function __construct($id, $select = "*")
    {
        $this->id = $id;

        $sql = Query::select("pages")->what($select)->where("id", $id)->order("position")->getSql();

        $this->init($sql);
    }

    public static function initGroup($lng, $select = "*", $visible = null, $menu = "all")
    {
        $sql = Query::select("pages")->what($select)->where("language", $lng)->order("position");

        if ($visible !== null)
        {
            $sql->wAnd("visible", ($visible) ? "1" : "0");
        }

        if ($menu && $menu !== "all")
        {
            if ($menu == "top")
            {
               $sql->wAnd("visible_in_main_menu", "1");
            }
            elseif ($menu == "sidebar")
            {
                $sql->wAnd("visible_in_sidebar", "1");
            }
        }

        return self::initSome($sql->getSql());
    }
}