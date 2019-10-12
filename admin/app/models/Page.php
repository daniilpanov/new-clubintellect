<?php


namespace admin\app\models;


use admin\app\models\Db\Query;

class Page extends Model
{
    // TODO: change properties to valid
    public $id;
    public $parent_id;
    public $description;
    public $keywords;
    public $title;
    public $menu_icon;
    public $icon_size;
    public $menu_number;
    public $menu_name;
    public $position;
    public $content;
    public $language;
    public $created;
    public $lastmod;
    public $visible_in_main_menu;
    public $visible_in_sidebar;
    public $active_link_in_sidebar;
    public $reviews_visible;
    public $reviews_add;
    public $contacts_visible;
    public $contacts_files_attach;

    public function __construct($id, $select = "*")
    {
        $this->id = $id;

        $sql = Query::select("pages")->what($select)->where("id", $id)->getSql();

        $this->init($sql);
        echo "<br>";
    }

    public static function initGroup($lng, $select = "*")
    {
        return self::initSome(Query::select("pages")->what($select)->where("language", $lng)->getSql());
    }
}