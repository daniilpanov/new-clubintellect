<?php


namespace admin\app\models\Db;


use admin\app\Factory;
use admin\app\models\Model;

abstract class Query extends Model
{
    protected $sql = null;

    abstract public function getSql($reinit = true);

    public static function select($table): Select
    {
        return Factory::createModel("Db\\Select", null, false, $table);
    }
}