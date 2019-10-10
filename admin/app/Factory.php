<?php


namespace admin\app;


class Factory
{
    public static $root_namespace = "";

    private static $controllers;
    private static $models;
    //private static $other_objects;

    public static function getController($controller)
    {
        if (!isset(self::$controllers[$controller]))
        {
            $namespace = self::$root_namespace . "controllers\\" . $controller;
            self::$controllers[$controller] = new $namespace;
        }

        return self::$controllers[$controller];
    }

    public static function createModelArr($name, $params, $group = null)
    {
        if ($group == null)
            $group = 'default';

        $group_models = &self::$models[$group];

        if (!isset($group_models[$name]))
            $group_models[$name] = [];

        $needle_models = &$group_models[$name];
        $namespace = self::$root_namespace . "models\\" . $name;

        return $needle_models[] = new $namespace(...$params);
    }

    public static function createModel($name, $group = null, ...$params)
    {
        return self::createModelArr($name, $params, $group);
    }

    public static function searchModel($name, $params)
    {
        return self::searchModelInGroup($name, 'default', $params);
    }

    public static function searchModelInGroup($name, $group, $params)
    {
        $control_sum = count($params);
        $found_models = [];

        foreach (self::$models[$group][$name] as $object)
        {
            $counter = 0;

            foreach ($params as $property => $value)
            {
                if (isset($object->$property))
                {
                    if ($object->$property == $value)
                    {
                        $counter ++;
                    }
                }
            }

            if ($counter == $control_sum)
            {
                $found_models[$name] = $object;
            }
        }

        return $found_models;
    }

    public static function getGroup($group)
    {
        return isset(self::$models[$group]) ? self::$models[$group] : null;
    }
}