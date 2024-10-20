<?php

namespace CORE;

use PDO;

class Database
{
    public $connection;
   public function __construct($config,$username,$password)
    {
       $dsn='mysql:'.http_build_query($config,$username='root',$password='12345');
       $this->connection=new PDO($dsn,$username,$password,[
           PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC
       ]);
    }
    public function query($query)
    {
        $statement=$this->connection->prepare($query);
        $statement->execute();
    }
    public function insert($table, $data)
    {

        $columns = implode(", ", array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $this->query($query, $data);
    }
    public function update($table, $data, $conditions)
    {

        $set = '';
        foreach ($data as $column => $value) {
            $set .= "$column = :$column, ";
        }
        $set = rtrim($set, ', ');


        $where = '';
        foreach ($conditions as $column => $value) {
            $where .= "$column = :cond_$column AND ";
        }
        $where = rtrim($where, ' AND ');


        $query = "UPDATE $table SET $set WHERE $where";

        $params = array_merge($data, array_combine(
            array_map(fn($key) => "cond_$key", array_keys($conditions)),
            array_values($conditions)
        ));

        $this->query($query, $params);
    }
    public function delete($table, $conditions)
    {

        $where = '';
        foreach ($conditions as $column => $value) {
            $where .= "$column = :cond_$column AND ";
        }
        $where = rtrim($where, ' AND ');


        $query = "DELETE FROM $table WHERE $where";


        $params = array_combine(
            array_map(fn($key) => "cond_$key", array_keys($conditions)),
            array_values($conditions)
        );

        $this->query($query, $params);
    }

}