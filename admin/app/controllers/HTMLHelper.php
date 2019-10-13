<?php


namespace admin\app\controllers;


use admin\app\Factory;
use admin\app\models\HTMLDocument;

class HTMLHelper extends Controller
{
    private $html_model = null;

    public function begin($title, $lng): self
    {
        $this->html_model = Factory::createModel("HTMLDocument", null, false, $title, $lng);
        return $this;
    }

    public function head(): HTMLDocument
    {
        return $this->html_model->createHead();
    }

    public function body(): HTMLDocument
    {
        return $this->html_model->renderHead()->createBody();
    }

    public function end()
    {
        $this->html_model->renderBody()->rendering();
    }
}