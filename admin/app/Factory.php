<?php


namespace admin\app;


class Factory
{
    public static $root_namespace = "";

    private static $controllers = [];
    private static $models = [];
    private static $reflections = [];
    //private static $other_objects;

    /**
     * @param $ref_class
     * @return \ReflectionClass|bool
     */
    public static function getReflection($ref_class)
    {
        if (!isset(self::$reflections[$ref_class]))
        {
            try
            {
                self::$reflections[$ref_class] = new \ReflectionClass($ref_class);
            }
            catch (\ReflectionException $ex)
            {
                return false;
            }
        }

        return self::$reflections[$ref_class];
    }

    public static function getController($controller, $use_def_namespace = true)
    {
        if (!isset(self::$controllers[$controller]))
        {
            $namespace = ($use_def_namespace) ? self::$root_namespace . "controllers\\" . $controller : $controller;
            self::$controllers[$controller] = new $namespace;
        }

        return self::$controllers[$controller];
    }

    public static function createModelArr($name, $params, $group = null, $save = true)
    {
        $namespace = self::$root_namespace . "models\\" . $name;

        if (!$save)
            return new $namespace(...$params);

        if ($group == null)
            $group = 'default';

        $group_models = &self::$models[$group];

        if (!isset($group_models[$name]))
            $group_models[$name] = [];

        $needle_models = &$group_models[$name];

        return $needle_models[] = new $namespace(...$params);
    }

    public static function createModel($name, $group = null, $save = true, ...$params)
    {
        return self::createModelArr($name, $params, $group, $save);
    }

    public static function createModelGroup($name, ...$params)
    {
        $namespace = self::$root_namespace . "models\\" . $name;
        return self::$models['default'][$name]
            = array_merge(
            $namespace::initGroup(...$params),
            (isset(self::$models['default'][$name]) ? self::$models['default'][$name] : [])
        );
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