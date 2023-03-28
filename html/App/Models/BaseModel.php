<?php
namespace App\Models;

use \Envms\FluentPDO\Query;

class BaseModel 
{
    public Query $query;
    public function start(): Query
    {
        $pdo = new \PDO("mysql:host=".$_ENV['DB_HOST'].";dbname=".$_ENV['DB_NAME']."", $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], array(
            \PDO::ATTR_EMULATE_PREPARES => false,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ));
        $this->query = new Query($pdo);
        return $this->query;
    }
}