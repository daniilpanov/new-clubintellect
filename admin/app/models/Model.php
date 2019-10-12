<?php


namespace admin\app\models;


use admin\app\Factory;

abstract class Model
{
    protected static function initSome($sql)
    {
        $info = Factory::getController("Db")->query($sql)->fetchAll();
        return self::initSomeFromArr($info);
    }

    protected static function initSomeFromArr($arr)
    {
        $models = [];
        $ref = Factory::getReflection(static::class);

        foreach ($arr as $item)
        {
            $current = $models[] = $ref->newInstanceWithoutConstructor();
            $current->initFromArr($item);
        }

        return $models;
    }

    protected function init($sql)
    {
        $info = Factory::getController("Db")->query($sql)->fetch();
        $this->initFromArr($info);
    }

    private function initFromArr($data)
    {
        $properties = get_object_vars($this);

        foreach ($properties as $col => $value)
        {
            $this->$col = (isset($data[$col]) ? $data[$col] : $this->$col);
        }
    }
}