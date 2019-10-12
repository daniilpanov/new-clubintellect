<?php


namespace admin\app\controllers;


use admin\app\Factory;

class Render extends Controller
{
    private $renders = [];

    public function render($view, ...$data)
    {
        if (!$model = Factory::searchModel("View", ['view_name' => $view]))
            $model = Factory::createModel("View", true, true, $view);

        $new_data = [];

        foreach ($data as $datum)
        {
            foreach ($datum as $var_name => $var_value)
            {
                $var_name = str_replace("-", "_", $var_name);
                $new_data[$var_name] = $var_value;
            }
        }

        $this->renders[] = ['model' => $model, 'data' => $new_data];
    }

    public function makeVisible()
    {
        foreach ($this->renders as $render)
        {
            $render['model']->render($render['data']);
        }
    }
}