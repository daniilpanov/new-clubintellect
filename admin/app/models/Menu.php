<?php


namespace admin\app\models;


class Menu extends Model
{
    public $id;
    public $name;
    public $position;
    public $visibility;
    public $header_visibility;
    public $created;
    public $last_mod;
    public $language;
}