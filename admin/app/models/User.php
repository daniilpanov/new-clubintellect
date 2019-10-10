<?php


namespace admin\app\models;


class User extends Model
{
    public $id;
    public $login;
    public $password;
    public $first_name;
    public $last_name;
    public $email;

    public function authorize($login, $password)
    {

    }
}