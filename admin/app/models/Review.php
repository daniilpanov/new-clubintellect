<?php


namespace admin\app\models;


class Review extends Model
{
    public $id;
    public $author;
    public $header;
    public $rating;
    public $visibility;
    public $content;
    public $created;
    public $last_mod;
}