<?php


namespace admin\app\models\Db;


use admin\app\controllers\Db;
use admin\app\Factory;
use admin\app\models\Model;

abstract class Query extends Model
{
    protected $sql = null;
    protected $named_templates = [];

    abstract public function getSql($reinit = true);

    public static function select($table): Select
    {
        return Factory::createModel("Db\\Select", null, false, $table);
    }

    public function query(bool $fetch, bool $all = true)
    {
        //echo $this->getSql();
        $res = Db::inst()->safetyQuery($this->getSql(), $this->named_templates);

        if ($fetch)
            $res = ($all) ? $res->fetchAll() : $res->fetch();

        return $res;
    }
}