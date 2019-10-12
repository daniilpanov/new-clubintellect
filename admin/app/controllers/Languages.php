<?php


namespace admin\app\controllers;


use admin\app\Factory;

class Languages extends ActionController
{
    private $languages;

    public function __construct()
    {
        $this->languages['ru']
            = Factory::createModel("Language", null, false, "ru");
        $this->languages['en']
            = Factory::createModel("Language", null, false, "en");
    }

    public function setCurrentLanguage($abbr)
    {

    }

    public function getCurrentLanguage()
    {

    }
}