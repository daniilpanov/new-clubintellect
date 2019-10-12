<?php

namespace admin\app\controllers;


use admin\app\Factory;
use admin\app\models\Routing;

class Router extends Controller
{
    const GET_REQUEST = "G",
        POST_REQUEST = "P",
        PUT_REQUEST = "U",
        DELETE_REQUEST = "D",
        PATH_REQUEST = "A",
        URL_REQUEST = "R";

    private $requests = [];

    public $default_namespace = "";
    public $default_controller = "";

    public function __construct()
    {
    }

    public function get($controller = null, $use_default_namespace = true): Routing
    {
        return $this->request(self::GET_REQUEST, $controller, $use_default_namespace);
    }

    public function post($controller = null, $use_default_namespace = true): Routing
    {
        return $this->request(self::POST_REQUEST, $controller, $use_default_namespace);
    }

    private function request($type, $controller = null, $use_default_namespace = true): Routing
    {
        if ($controller === null)
            $controller = $this->default_controller;
        $full_controller_namespace
            = ($use_default_namespace)
                ? $this->default_namespace . $controller
                : $controller;

        return $this->requests[$type][]
            = Factory::createModel(
                "Routing", null,
                false, $full_controller_namespace
        );
    }

    /**
     * @param $requests
     * @return array|null
     */
    public function route($requests): array
    {
        $responses = [];

        foreach ($this->requests as $type => $request_models)
        {
            foreach ($request_models as $request_model)
            {
                foreach ($requests[$type] as $request)
                {
                    if ($res = $request_model->init(['key' => $request['key'], 'value' => $request['value']]))
                    {
                        $responses[$type][] = $res;
                    }
                }
            }
        }

        /*foreach ($this->waiting as $item)
        {
            foreach ($item as $item2)
            {
                if (!$item2['required'])
                {

                }
            }
        }*/

        return $responses;
    }
}