<?php

namespace CORE;

use PDO;
use PDOException;

class Database
{
    public $connection;

    public function __construct($config, $username, $password)
    {
        // بناء سلسلة DSN
        $dsn = 'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'] . ';charset=' . $config['charset'];

        try {
            // إنشاء اتصال PDO
            $this->connection = new PDO($dsn, $username, $password, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // تفعيل الاستثناءات
            ]);
        } catch (PDOException $e) {
            die('فشل الاتصال: ' . $e->getMessage());
        }
    }

    public function query($query, $params = [])
    {
        $statement = $this->connection->prepare($query);
        $statement->execute($params);
        return $statement; // إرجاع الكائن الناتج
    }

    public function insert($table, $data)
    {
        $columns = implode(", ", array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $this->query($query, $data); // تمرير البيانات
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
