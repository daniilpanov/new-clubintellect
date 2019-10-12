<?php


namespace admin\app\controllers;


use PDO;

class Db extends Controller
{
    private $PDO;
    private $host, $db, $user, $pass, $charset;

    public static $options = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    public function __construct()
    {
        $this->host = "localhost";
        $this->db = "clubintellect";
        $this->user = "php";
        $this->pass = "12345";
        $this->charset = "utf8";

        $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
        try
        {
            $this->PDO = new PDO($dsn, $this->user, $this->pass, self::$options);
        }
        catch (\PDOException $ex)
        {
            die($ex->getMessage());
        }

        $this->query("SET NAMES " . $this->charset);
    }

    public function query($sql_query)
    {
        return $this->PDO->query($sql_query);
    }
}