<?php
namespace app\classes;


class Muninstall
{
    protected function getAllTables($DB)
    {
        $sql = "SHOW TABLES FROM " . $DB;

        $tables = Db::getInstance()->sql($sql);

        return $tables;
    }
}