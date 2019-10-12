<?php


namespace admin\app\models;


use admin\app\models\Db\Query;

class Menu extends Model
{
    public $id;
    public $menu_name;
    public $position;
    public $visibility;
    public $header_visibility;
    public $created;
    public $last_mod;
    public $language;

    public function __construct($id, $lng, $select = "*")
    {
        $this->init(
            Query::select("menus")->what($select)
                ->where("id", $id)->wAnd("language", $lng)
                ->getSql()
        );
    }

    public static function initGroup($lng, $select = "*")
    {
        return self::initSome(Query::select("menus")->what($select)->where("language", $lng)->getSql());
    }
}