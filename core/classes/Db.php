<?php

class Db
{
    private $conn;

    public function __construct(array $db_config){
        $dns = "mysql:host={$db_config['host']};dbname={$db_config['dbname']};charset={$db_config['charset']}";
        try {
            $this->conn = new PDO($dns, $db_config['username'], $db_config['password'], $db_config['options']);
        }catch (PDOException $e){
            abort(500);
            die;
        }

    }

    public function query($query){
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}