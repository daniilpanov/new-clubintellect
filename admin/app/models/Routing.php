<?php


namespace admin\app\models;


use admin\app\Factory;

class Routing extends Model
{
    public
        $controller,
        $key = null,
        $values = []; // [<pattern> => <method>]

    public function __construct($controller)
    {
        $this->controller = $controller;
    }

    public function key($key_pattern): self
    {
        $this->key = $key_pattern;

        return $this;
    }

    public function value($value_pattern, $method = null): self
    {
        if ($value_pattern == null)
            $value_pattern = 'default';
        $this->values[$value_pattern] = $method;

        return $this;
    }

    public function init($request)
    {
        if ($this->key === null)
        {
            if ($request['key'] === null)
                return $this->call();
        }
        else
        {
            if (!empty($request))
            {
                $key = $request['key'];

                if (preg_match("/" . $this->key . "/", $key, $params))
                {
                    unset($params[0]);
                    $value = (isset($request['value']) ? $request['value'] : null);

                    if ($value === null && isset($this->values['default']))
                    {
                        return $this->call($this->values['default'], $params);
                    }
                    else
                    {
                        foreach ($this->values as $pattern => $method)
                        {
                            if (preg_match("/" . $pattern . "/", $value, $params))
                            {
                                unset($params[0]);

                                return $this->call($method, $params);
                            }
                        }
                    }
                }
            }
        }

        return false;
    }

    private function call($method = null, $params = [])
    {
        $inst = Factory::getController(
            $this->controller,
            false
        );

        return ($method !== null)
            ? $inst->$method(...$params)
            : $inst(...$params);
    }
}