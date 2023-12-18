<?php

namespace classes;
use PDO;
use PDOException;
//use PDOStatement;

final class Db
{
    private $connection;
    private $stmt;
    private static $instance =null;

    private function __construct(){}

    public static function getInstance(){
        if(self::$instance === null ){
            self::$instance = new self();
        }

        return self::$instance;
    }


    public function getConnection(array $db_config){
        $dns = "mysql:host={$db_config['host']};dbname={$db_config['dbname']};charset={$db_config['charset']}";
        try {
            $this->connection = new PDO($dns, $db_config['username'], $db_config['password'], $db_config['options']);
            return $this;
        }catch (PDOException $e){
            abort(500);
            die;
        }
    }



    public function query($query, $params = []){
        try{
            $this->stmt = $this->connection->prepare($query);
            $this->stmt->execute($params);
            return $this;
        }catch (PDOException $e){
            return false;
        }

    }

    public function findAll(){
        return $this->stmt->fetchAll();
    }

    public function find(){
        return $this->stmt->fetch();
    }

    public function findOrFail() {
        $res = $this->find();
        if(!$res) {
            abort();
        }
        return $res;
    }

}