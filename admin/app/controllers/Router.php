<?php

namespace admin\app\controllers;


use admin\app\Factory;

class Router extends Controller
{
    const GET_REQUEST = "G",
        POST_REQUEST = "P",
        PUT_REQUEST = "U",
        DELETE_REQUEST = "D",
        PATH_REQUEST = "A",
        URL_REQUEST = "R";

    private $patterns = [];

    public $default_namespace = "";
    public $default_controller = "";

    public function __construct()
    {
    }

    public function get($get_pattern, $controller, $method = null, $use_default_namespace = true): bool
    {
        return $this->request(self::GET_REQUEST, $get_pattern, $controller, $method, $use_default_namespace);
    }

    public function post($post_pattern, $controller = null, $method = null, $use_default_namespace = true): bool
    {
        return $this->request(self::POST_REQUEST, $post_pattern, $controller, $method, $use_default_namespace);
    }

    public function request($type, $pattern, $controller = null, $method = null, $use_default_namespace = true): bool
    {
        if ($controller === null)
            $controller = $this->default_controller;

        if ($use_default_namespace)
            $controller = $this->default_namespace . $controller;

        if (!class_exists($controller))
            return false;

        $this->patterns[$type][$controller] = ['pattern' => $pattern, 'method' => $method];
        return true;
    }

    /**
     * @param $requests
     * @return array|null
     */
    public function route($requests): array
    {
        $data = [];

        foreach ($requests as $type => $request)
            $data[$type] = $this->request_check($type, $request);

        return $data;
    }

    private function request_check($type, $data)
    {
        $result = null;

        foreach ($data as $key => $request)
        {
            $full_req = ($request !== null) ? $key . "=" . $request : $key;

            foreach ($this->patterns[$type] as $controller => $pattern)
            {
                if (preg_match($pattern['pattern'], $full_req, $params))
                {
                    unset($params[0]);
                    $control = Factory::getController($controller);
                    $method = $pattern['method'];

                    $result[$full_req] =
                        ($method != null)
                            ? $control->$method(...$params)
                            : $control(...$params);
                }
            }
        }

        return $result;
    }
}