<?php


namespace admin\app\models;


class Page extends Model
{
    public $id;
    public $name;
    public $icon; // ['icon' => <icon-name>, 'size' => <icon-size>]
    public $content;
    public $title;
    public $author;
    public $position;
    public $sidebar_menu;
    public $parent_page;
    public $description;
    public $keywords;
    public $created;
    public $last_mod;
    public $visibility; // ['sidebar' => <bool>, 'top' => <bool>]
    public $reviews; // From table reviews (where page = $id)
    public $language; // Model 'Language'
}