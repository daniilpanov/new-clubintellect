<?php


namespace admin\app\models;


class Language extends Model
{
    public $id;
    public $abbr;
    public $language;
    public $status;
    public $is_main;

    public function __construct($lng)
    {
        $this->abbr = $lng;
    }
}