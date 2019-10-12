<?php


namespace admin\app\controllers;


use admin\app\Factory;

class HTMLHelper extends Controller
{
    private $html_model = null;

    public function begin()
    {
        Factory::createModel("HTMLDocument", null, false, "title", "ru");
    }

    public function head()
    {
        return $this->html_model->createHead();
    }

    public function body()
    {
        $this->html_model->renderHead()->createBody();
    }

    public function end()
    {
        $this->html_model->renderBody()->rendering();
    }
}