<?php


namespace admin\app\controllers;


use admin\app\Factory;
use admin\app\models\HTMLDocument;

class HTMLHelper extends Controller
{
    /** @var $html_model HTMLDocument|null */
    private $html_model = null;

    public function begin($title, $lng): self
    {
        $this->html_model = Factory::createModel("HTMLDocument", null, false, $title, $lng);
        return $this;
    }

    public function head(): HTMLDocument
    {
        return $this->getDocModel()->createHead();
    }

    public function body(): HTMLDocument
    {
        return $this->getDocModel()->renderHead()->createBody();
    }

    public function end()
    {
        $this->getDocModel()->renderBody()->rendering();
    }

    public function getDocModel(): HTMLDocument
    {
        return $this->html_model;
    }
}