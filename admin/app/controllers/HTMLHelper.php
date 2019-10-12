<?php


namespace admin\app\controllers;


use admin\app\Factory;

class HTMLHelper extends Controller
{
    public function begin()
    {
        Factory::createModel("HTMLDocument", null, false, "title", "ru");
    }

    public function head()
    {

    }

    public function end()
    {

    }
}